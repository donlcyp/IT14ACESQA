<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FinancialData;

class FinanceSectionsController extends Controller
{
    public function revenue()
    {
        $currentYear = date('Y');
        $items = FinancialData::where('year', $currentYear)
            ->orderBy('month')
            ->get();
        return view('finance.revenue', compact('items', 'currentYear'));
    }

    public function expenses()
    {
        $currentYear = date('Y');
        $items = FinancialData::where('year', $currentYear)
            ->orderBy('month')
            ->get();
        return view('finance.expenses', compact('items', 'currentYear'));
    }

    public function budgetIndex()
    {
        $currentYear = date('Y');
        $path = "budgets_{$currentYear}.json";
        $budgets = [];
        if (Storage::disk('local')->exists($path)) {
            $budgets = json_decode(Storage::disk('local')->get($path), true) ?: [];
        }
        $summary = [
            'total_revenue' => FinancialData::where('year', $currentYear)->sum('revenue'),
            'total_expenses' => FinancialData::where('year', $currentYear)->sum('expenses'),
        ];
        $summary['net'] = $summary['total_revenue'] - $summary['total_expenses'];
        return view('finance.budget', compact('budgets', 'currentYear', 'summary'));
    }

    public function budgetStore(Request $request)
    {
        $data = $request->validate([
            'year' => 'required|integer',
            'monthly' => 'required|array',
        ]);
        $path = "budgets_{$data['year']}.json";
        Storage::disk('local')->put($path, json_encode($data['monthly']));
        return back()->with('status', 'Budget targets saved.');
    }

    public function purchaseOrdersIndex()
    {
        $path = 'purchase_orders.json';
        $orders = [];
        if (Storage::disk('local')->exists($path)) {
            $orders = json_decode(Storage::disk('local')->get($path), true) ?: [];
        }
        return view('finance.purchase-orders', compact('orders'));
    }

    public function purchaseOrdersStore(Request $request)
    {
        $payload = $request->validate([
            'supplier' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);
        $path = 'purchase_orders.json';
        $orders = [];
        if (Storage::disk('local')->exists($path)) {
            $orders = json_decode(Storage::disk('local')->get($path), true) ?: [];
        }
        $payload['id'] = uniqid('po_');
        $payload['status'] = 'Pending';
        $payload['created_at'] = now()->toDateTimeString();
        $orders[] = $payload;
        Storage::disk('local')->put($path, json_encode($orders));
        return back()->with('status', 'Purchase order submitted.');
    }

    public function purchaseOrdersUpdateStatus(Request $request, $id)
    {
        $status = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected,Received'
        ]);
        $path = 'purchase_orders.json';
        $orders = [];
        if (Storage::disk('local')->exists($path)) {
            $orders = json_decode(Storage::disk('local')->get($path), true) ?: [];
        }
        foreach ($orders as &$o) {
            if ($o['id'] === $id) {
                $o['status'] = $status['status'];
                break;
            }
        }
        Storage::disk('local')->put($path, json_encode($orders));
        return back()->with('status', 'Status updated.');
    }
}
