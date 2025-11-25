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
        // Get all projects with related materials through purchase orders
        $projects = Project::with(['purchaseOrders.material'])
            ->orderByDesc('created_at')
            ->get();

        // Calculate statistics for each project
        $projects = $projects->map(function($project) {
            $materials = $project->purchaseOrders->pluck('material')->filter();
            $failedMaterials = $materials->where('status', 'Fail');
            $project->failed_count = $failedMaterials ? $failedMaterials->count() : 0;
            $project->suppliers = $materials->pluck('supplier')->unique()->filter()->values();
            return $project;
        });

        return view('transactions.index', compact('projects'));
    }

    /**
     * Show project details with "To Be Returned" materials
     */
    public function show($id)
    {
        $project = Project::with(['purchaseOrders' => function($query) {
            $query->whereHas('material', function($q) {
                $q->where('status', 'Fail');
            })->with('material');
        }])->findOrFail($id);

        // Get unique suppliers from this project's materials
        $suppliers = Material::whereHas('purchaseOrders', function($q) use ($id) {
            $q->where('project_id', $id);
        })
            ->whereNotNull('supplier')
            ->where('supplier', '!=', '')
            ->distinct()
            ->pluck('supplier');

        return view('transactions.show', compact('project', 'suppliers'));
    }

    /**
     * Show invoice for a specific supplier in a project
     */
    public function invoice($projectId, $supplier)
    {
        $project = Project::findOrFail($projectId);
        
        // Get APPROVED materials only for the main invoice
        $materials = Material::whereHas('purchaseOrders', function($q) use ($projectId) {
            $q->where('project_id', $projectId);
        })
            ->where('supplier', $supplier)
            ->where('status', 'Approved')
            ->get();

        // Get FAILED materials separately for return invoice section
        $failedMaterials = Material::whereHas('purchaseOrders', function($q) use ($projectId) {
            $q->where('project_id', $projectId);
        })
            ->where('supplier', $supplier)
            ->where('status', 'Fail')
            ->get();

        // Calculate totals for approved materials only
        $subtotal = $materials->sum('total_cost');
        $tax = $subtotal * 0.12; // 12% VAT
        $total = $subtotal + $tax;

        // Total value of failed materials (for reference/return invoice)
        $failedSubtotal = $failedMaterials->sum('total_cost');

        // Get purchase history for this project
        $purchaseHistory = $this->getPurchaseHistory($projectId, $supplier);

        return view('transactions.invoice', compact(
            'project',
            'supplier',
            'materials',
            'failedMaterials',
            'subtotal',
            'tax',
            'total',
            'failedSubtotal',
            'purchaseHistory'
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
