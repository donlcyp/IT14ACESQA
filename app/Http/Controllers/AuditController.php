<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class AuditController extends Controller
{
    public function index()
    {
        $approvedInvoices = Invoice::with('creator')
            ->approved()
            ->orderByDesc('invoice_date')
            ->orderByDesc('created_at')
            ->get();

        $pendingInvoices = Invoice::with('creator')
            ->pending()
            ->orderByDesc('invoice_date')
            ->orderByDesc('created_at')
            ->get();

        $invoiceLogs = Invoice::with('creator')->orderByDesc('created_at')->take(15)->get();

        return view('audit', compact('approvedInvoices', 'pendingInvoices', 'invoiceLogs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => ['required', 'string', 'max:255', 'unique:invoices,invoice_number'],
            'purchase_order_number' => ['nullable', 'string', 'max:255'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:paid,unpaid,partial'],
            'approval_status' => ['required', 'in:approved,pending'],
            'invoice_date' => ['nullable', 'date'],
            'verification_date' => ['nullable', 'date'],
            'payment_date' => ['nullable', 'date'],
        ]);

        $invoice = Invoice::create([
            'created_by' => $request->user()->id ?? null,
            'invoice_number' => $validated['invoice_number'],
            'purchase_order_number' => $validated['purchase_order_number'] ?? null,
            'total_amount' => $validated['total_amount'],
            'payment_status' => $validated['payment_status'],
            'approval_status' => $validated['approval_status'],
            'invoice_date' => $validated['invoice_date'] ?? null,
            'verification_date' => $validated['verification_date'] ?? null,
            'payment_date' => $validated['payment_date'] ?? null,
        ]);

        session()->flash('transaction_success', 'Invoice '.$invoice->invoice_number.' added successfully.');

        return redirect()->route('transaction');
    }
}
