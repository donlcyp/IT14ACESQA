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
        
        // Get all materials from this supplier for this project
        $materials = Material::where('project_record_id', $projectId)
            ->where('supplier', $supplier)
            ->get();

        // Calculate totals
        $subtotal = $materials->sum('total');
        $tax = $subtotal * 0.12; // 12% VAT
        $total = $subtotal + $tax;

        // Get purchase history for this project
        $purchaseHistory = $this->getPurchaseHistory($projectId, $supplier);

        return view('transactions.invoice', compact('project', 'supplier', 'materials', 'subtotal', 'tax', 'total', 'purchaseHistory'));
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
