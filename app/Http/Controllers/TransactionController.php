<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectRecord;
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
        // Get all projects with materials
        $projects = ProjectRecord::with(['materials' => function($query) {
            $query->select('project_record_id', 'status', 'supplier', 'price', 'total')
                  ->whereNotNull('supplier');
        }])
        ->orderBy('created_at', 'desc')
        ->get();

        // Calculate statistics for each project
        $projects = $projects->map(function($project) {
            $failedMaterials = $project->materials->where('status', 'Fail');
            $project->failed_count = $failedMaterials->count();
            $project->suppliers = $project->materials->pluck('supplier')->unique()->filter()->values();
            return $project;
        });

        return view('transactions.index', compact('projects'));
    }

    /**
     * Show project details with "To Be Returned" materials
     */
    public function show($id)
    {
        $project = ProjectRecord::with(['materials' => function($query) {
            $query->where('status', 'Fail');
        }])->findOrFail($id);

        // Get unique suppliers from this project's materials
        $suppliers = Material::where('project_record_id', $id)
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
        $project = ProjectRecord::findOrFail($projectId);
        
        // Get APPROVED materials only for the main invoice
        $materials = Material::where('project_record_id', $projectId)
            ->where('supplier', $supplier)
            ->where('status', 'Approved')
            ->get();

        // Get FAILED materials separately for return invoice section
        $failedMaterials = Material::where('project_record_id', $projectId)
            ->where('supplier', $supplier)
            ->where('status', 'Fail')
            ->get();

        // Calculate totals for approved materials only
        $subtotal = $materials->sum('total');
        $tax = $subtotal * 0.12; // 12% VAT
        $total = $subtotal + $tax;

        // Total value of failed materials (for reference/return invoice)
        $failedSubtotal = $failedMaterials->sum('total');

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
        $query = Material::where('project_record_id', $projectId)
            ->select('id', 'name', 'supplier', 'quantity', 'price', 'total', 'status', 'date_received', 'created_at')
            ->orderBy('created_at', 'desc');

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
        $history = Material::with('projectRecord')
            ->select('id', 'project_record_id', 'name', 'supplier', 'quantity', 'unit', 'price', 'total', 'status', 'date_received', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('transactions.history', compact('history'));
    }
}
