<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialData;
use App\Models\Invoice;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        // Get all materials with their costs
        $materials = Material::with(['projectRecord', 'project'])
            ->orderBy('date_received', 'desc')
            ->get();

        // Calculate financial metrics from materials
        $totalExpenses = $materials->sum('total_cost');
        $approvedExpenses = $materials->where('status', 'approved')->sum('total_cost');
        $pendingExpenses = $materials->where('status', 'pending')->sum('total_cost');
        $failedExpenses = $materials->where('status', 'failed')->sum('total_cost');

        // Group by project for cost breakdown
        $projectCosts = $materials->groupBy('project_id')
            ->map(function ($items) {
                return (object) [
                    'project_id' => $items->first()->project_id,
                    'project' => $items->first()->project,
                    'material_count' => $items->count(),
                    'total_cost' => $items->sum('total_cost'),
                ];
            })
            ->values()
            ->sortByDesc('total_cost');

        return view('finance.index', compact(
            'materials',
            'totalExpenses',
            'approvedExpenses',
            'pendingExpenses',
            'failedExpenses',
            'projectCosts'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2100',
            'month' => 'required|integer|min:1|max:12',
            'revenue' => 'required|numeric|min:0',
            'expenses' => 'required|numeric|min:0',
        ]);

        try {
            FinancialData::updateOrCreate(
                [
                    'year' => $request->year,
                    'month' => $request->month,
                ],
                [
                    'revenue' => $request->revenue,
                    'expenses' => $request->expenses,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Financial data saved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function supplierInvoices()
    {
        // Get all materials with supplier information
        $materials = Material::with(['projectRecord', 'project'])
            ->orderBy('date_received', 'desc')
            ->get();

        // Get unique suppliers
        $suppliers = $materials
            ->where('supplier', '!=', null)
            ->groupBy('supplier')
            ->map(function ($items) {
                return $items->first();
            })
            ->values();

        // Calculate invoice summary
        $totalInvoiceAmount = $materials->sum('total_cost');
        $paidAmount = $materials->where('status', 'approved')->sum('total_cost');
        $unpaidAmount = $materials->where('status', '!=', 'approved')->sum('total_cost');

        return view('finance.supplier-invoices', compact(
            'materials',
            'suppliers',
            'totalInvoiceAmount',
            'paidAmount',
            'unpaidAmount'
        ));
    }

    public function paymentSummary()
    {
        // Get all materials
        $materials = Material::with(['projectRecord', 'project'])
            ->orderBy('date_received', 'desc')
            ->get();

        // Get unpaid materials
        $unpaidMaterials = $materials->where('status', '!=', 'approved');

        // Calculate payment summary
        $totalAmount = $materials->sum('total_cost');
        $paidAmount = $materials->where('status', 'approved')->sum('total_cost');
        $unpaidAmount = $materials->where('status', '!=', 'approved')->sum('total_cost');

        return view('finance.payment-summary', compact(
            'materials',
            'unpaidMaterials',
            'totalAmount',
            'paidAmount',
            'unpaidAmount'
        ));
    }
}
