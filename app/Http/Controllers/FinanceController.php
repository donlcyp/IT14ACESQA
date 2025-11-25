<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialData;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        
        // Get financial data for the current year
        $financialData = FinancialData::where('year', $currentYear)
            ->orderBy('month', 'asc')
            ->get();

        // Calculate summary statistics
        $totalRevenue = FinancialData::where('year', $currentYear)->sum('revenue');
        $totalExpenses = FinancialData::where('year', $currentYear)->sum('expenses');
        $netProfit = $totalRevenue - $totalExpenses;
        
        // Get monthly data for current month
        $currentMonth = date('n');
        $monthlyRevenue = FinancialData::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->value('revenue') ?? 0;
        $monthlyExpenses = FinancialData::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->value('expenses') ?? 0;

        // Calculate average profit margin
        $avgProfitMargin = $totalRevenue > 0 
            ? round((($totalRevenue - $totalExpenses) / $totalRevenue) * 100, 1) 
            : 0;

        // Count total transactions from invoices table
        $totalTransactions = Invoice::count();

        return view('finance', compact(
            'financialData',
            'totalRevenue',
            'totalExpenses',
            'netProfit',
            'monthlyRevenue',
            'monthlyExpenses',
            'avgProfitMargin',
            'totalTransactions'
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
}
