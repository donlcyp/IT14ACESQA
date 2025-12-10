<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'created_by',
        'purchase_order_id',
        'invoice_number',
        'purchase_order_number',
        'total_amount',
        'amount',
        'payment_status',
        'approval_status',
        'invoice_date',
        'verification_date',
        'payment_date',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'amount' => 'decimal:2',
        'invoice_date' => 'date',
        'verification_date' => 'date',
        'payment_date' => 'date',
    ];

    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}


