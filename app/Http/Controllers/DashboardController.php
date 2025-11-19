<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\FinancialData;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        // You can add logic here to fetch dashboard data from models
        // Dashboard now uses live data instead of static placeholders.

        // Project summary
        $totalProjects = Project::where('archived', false)->count();

        $completeProjects = Project::where('archived', false)
            ->where('status', 'Completed')
            ->count();

        $ongoingProjects = Project::where('archived', false)
            ->where('status', '!=', 'Completed')
            ->count();

        $summary = [
            'total_projects' => $totalProjects,
            'complete_projects' => $completeProjects,
            'ongoing_projects' => $ongoingProjects,
        ];

        // Active projects (latest 5)
        $activeProjects = Project::where('archived', false)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Recent project material records (latest 5)
        $recentProjectRecords = ProjectRecord::orderByDesc('created_at')
            ->take(5)
            ->get();

        // Transaction reminders: unpaid or pending approval invoices
        $transactionReminders = Invoice::where(function ($query) {
                $query->where('payment_status', '!=', 'paid')
                      ->orWhere('approval_status', 'pending');
            })
            ->orderByDesc('invoice_date')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Finance summary (year-to-date and current month)
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        $totalRevenue = FinancialData::where('year', $currentYear)->sum('revenue');
        $totalExpenses = FinancialData::where('year', $currentYear)->sum('expenses');
        $netProfit = $totalRevenue - $totalExpenses;

        $monthlyRevenue = FinancialData::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->value('revenue') ?? 0;

        $monthlyExpenses = FinancialData::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->value('expenses') ?? 0;

        $avgProfitMargin = $totalRevenue > 0
            ? round((($totalRevenue - $totalExpenses) / $totalRevenue) * 100, 1)
            : 0;

        $totalTransactions = Invoice::count();

        $outstandingInvoicesAmount = Invoice::where('payment_status', '!=', 'paid')
            ->sum('total_amount');

        $pendingPaymentsAmount = Invoice::where('payment_status', '!=', 'paid')
            ->where('approval_status', 'approved')
            ->sum('total_amount');

        // Budget utilization based on saved yearly budget targets
        $budgetUtilization = null;
        $budgetPath = "budgets_{$currentYear}.json";

        if (Storage::disk('local')->exists($budgetPath)) {
            $budgetData = json_decode(Storage::disk('local')->get($budgetPath), true) ?: [];
            $budgetTotal = array_sum($budgetData);

            if ($budgetTotal > 0) {
                $budgetUtilization = round(($totalExpenses / $budgetTotal) * 100);
            }
        }

        $financeSummary = [
            'total_revenue' => $totalRevenue,
            'total_expenses' => $totalExpenses,
            'net_profit' => $netProfit,
            'total_transactions' => $totalTransactions,
            'avg_profit_margin' => $avgProfitMargin,
            'monthly_revenue' => $monthlyRevenue,
            'monthly_expenses' => $monthlyExpenses,
            'outstanding_invoices' => $outstandingInvoicesAmount,
            'pending_payments' => $pendingPaymentsAmount,
            'budget_utilization' => $budgetUtilization,
            'last_updated' => now(),
        ];

        return view('dashboard', compact(
            'summary',
            'activeProjects',
            'recentProjectRecords',
            'transactionReminders',
            'financeSummary'
        ));
    }
}
