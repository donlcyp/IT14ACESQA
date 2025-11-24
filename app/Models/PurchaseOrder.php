<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $primaryKey = 'purchase_order_id';
    protected $table = 'purchase_orders';

    protected $fillable = [
        'project_id',
        'material_id',
        'quantity',
        'order_date',
        'status',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    /**
     * Get the project this purchase order belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * Get the material this purchase order is for.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    /**
     * Get the invoices for this purchase order.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'purchase_order_id', 'purchase_order_id');
    }
}
