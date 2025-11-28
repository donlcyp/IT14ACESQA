<?php

namespace App\Observers;

use App\Models\PurchaseOrder;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderObserver
{
    public function created(PurchaseOrder $purchaseOrder): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'CREATE_PURCHASE_ORDER',
            'log_date' => now(),
            'details' => json_encode([
                'po_id' => $purchaseOrder->id,
                'project_id' => $purchaseOrder->project_id,
                'material_id' => $purchaseOrder->material_id,
                'quantity' => $purchaseOrder->quantity,
                'status' => $purchaseOrder->status,
            ]),
        ]);
    }

    public function updated(PurchaseOrder $purchaseOrder): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_PURCHASE_ORDER',
            'log_date' => now(),
            'details' => json_encode([
                'po_id' => $purchaseOrder->id,
                'changes' => $purchaseOrder->getChanges(),
            ]),
        ]);
    }

    public function deleted(PurchaseOrder $purchaseOrder): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'DELETE_PURCHASE_ORDER',
            'log_date' => now(),
            'details' => json_encode([
                'po_id' => $purchaseOrder->id,
            ]),
        ]);
    }
}
