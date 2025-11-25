<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display the transaction page with project list
     */
    public function index()
    {
        // Get all project records with related materials
        $projectRecords = \App\Models\ProjectRecord::with(['materials'])
            ->orderByDesc('created_at')
            ->get();

        // Calculate statistics for each project record
        $projectRecords = $projectRecords->map(function($record) {
            $materials = $record->materials;
            $failedMaterials = $materials->where('status', 'Fail');
            $record->failed_count = $failedMaterials ? $failedMaterials->count() : 0;
            // Get unique suppliers from materials
            $record->suppliers = $materials->where('supplier', '!=', null)
                ->where('supplier', '!=', '')
                ->pluck('supplier')
                ->unique()
                ->filter()
                ->values();
            return $record;
        });

        return view('transactions.index', ['projects' => $projectRecords]);
    }

    /**
     * Show project details with "To Be Returned" materials
     */
    public function show($id)
    {
        // Try to find as ProjectRecord first, then fallback to Project
        $projectRecord = \App\Models\ProjectRecord::find($id);
        if (!$projectRecord) {
            // Fallback to Project if not found
            $project = Project::findOrFail($id);
        } else {
            $project = $projectRecord->project;
        }

        // Get materials from ProjectRecord if available, otherwise from Project
        if ($projectRecord) {
            $projectRecord->load(['materials']);
            $allMaterials = $projectRecord->materials;
        } else {
            $project->load(['purchaseOrders' => function($query) {
                $query->with('material');
            }]);
            $allMaterials = $project->purchaseOrders->pluck('material')->filter();
        }

        // Get unique suppliers from materials
        $suppliers = $allMaterials
            ->where('supplier', '!=', null)
            ->where('supplier', '!=', '')
            ->pluck('supplier')
            ->unique()
            ->values();

        return view('transactions.show', compact('project', 'suppliers', 'projectRecord', 'allMaterials'));
    }

    /**
     * Show invoice for a specific supplier in a project
     */
    public function invoice($projectId, $supplier)
    {
        // Try to find as ProjectRecord first, then fallback to Project
        $projectRecord = \App\Models\ProjectRecord::find($projectId);
        if (!$projectRecord) {
            $project = Project::findOrFail($projectId);
        } else {
            $project = $projectRecord->project;
        }
        
        // Get materials from ProjectRecord if available
        if ($projectRecord) {
            $projectRecord->load(['materials']);
            $materials = $projectRecord->materials
                ->where('supplier', $supplier)
                ->where('status', 'Approved')
                ->values();
            $failedMaterials = $projectRecord->materials
                ->where('supplier', $supplier)
                ->where('status', 'Fail')
                ->values();
        } else {
            // Fallback to using purchase orders for Project
            $materials = Material::whereHas('purchaseOrders', function($q) use ($project) {
                $q->where('project_id', $project->id);
            })
                ->where('supplier', $supplier)
                ->where('status', 'Approved')
                ->get();

            $failedMaterials = Material::whereHas('purchaseOrders', function($q) use ($project) {
                $q->where('project_id', $project->id);
            })
                ->where('supplier', $supplier)
                ->where('status', 'Fail')
                ->get();
        }

        // Calculate totals for approved materials only
        $subtotal = $materials->sum('total_cost');
        $tax = $subtotal * 0.12; // 12% VAT
        $total = $subtotal + $tax;

        // Total value of failed materials (for reference/return invoice)
        $failedSubtotal = $failedMaterials->sum('total_cost');

        // Get purchase history for this project
        $purchaseHistory = $this->getPurchaseHistory($project->id, $supplier);

        return view('transactions.invoice', compact(
            'project',
            'supplier',
            'materials',
            'failedMaterials',
            'subtotal',
            'tax',
            'total',
            'failedSubtotal',
            'purchaseHistory',
            'projectRecord'
        ));
    }

    /**
     * Update reason for returning a failed material (remarks field)
     */
    public function updateReturnReason(Request $request, Material $material)
    {
        $validated = $request->validate([
            'remarks' => 'nullable|string|max:1000',
        ]);

        $material->remarks = $validated['remarks'] ?? null;
        $material->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Return reason updated successfully.',
            ]);
        }

        return back()->with('success', 'Return reason updated successfully.');
    }

    /**
     * Get purchase history (logs)
     */
    private function getPurchaseHistory($projectId, $supplier = null)
    {
        $query = Material::whereHas('purchaseOrders', function($q) use ($projectId) {
            $q->where('project_id', $projectId);
        })
            ->select('id', 'material_name', 'supplier', 'quantity_received', 'unit_of_measure', 'unit_price', 'total_cost', 'status', 'date_received', 'created_at')
            ->orderByDesc('created_at');

        if ($supplier) {
            $query->where('supplier', $supplier);
        }

        return $query->get();
    }

    /**
     * Show all purchase history
     */
    public function history()
    {
        $history = Material::with('purchaseOrders')
            ->select('id', 'material_name', 'supplier', 'quantity_received', 'unit_of_measure', 'unit_price', 'total_cost', 'status', 'date_received', 'created_at')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('transactions.history', compact('history'));
    }
}
