<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function created(Invoice $invoice): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
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
    }

    public function updated(Invoice $invoice): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'UPDATE_INVOICE',
                'log_date' => now(),
                'details' => json_encode([
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_number,
                    'changes' => $invoice->getChanges(),
                ]),
            ]);
        }
    }

    public function deleted(Invoice $invoice): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'DELETE_INVOICE',
                'log_date' => now(),
                'details' => json_encode([
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_number,
                ]),
            ]);
        }
    }
}
