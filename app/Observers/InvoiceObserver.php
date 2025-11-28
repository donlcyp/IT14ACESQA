<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function created(Invoice $invoice): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'CREATE_INVOICE',
            'log_date' => now(),
            'details' => json_encode([
                'invoice_id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
                'total_amount' => $invoice->total_amount,
                'payment_status' => $invoice->payment_status,
            ]),
        ]);
    }

    public function updated(Invoice $invoice): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_INVOICE',
            'log_date' => now(),
            'details' => json_encode([
                'invoice_id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
                'changes' => $invoice->getChanges(),
            ]),
        ]);
    }

    public function deleted(Invoice $invoice): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'DELETE_INVOICE',
            'log_date' => now(),
            'details' => json_encode([
                'invoice_id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
            ]),
        ]);
    }
}
