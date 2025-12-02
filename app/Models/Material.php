<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_record_id',
        'project_id',
        'item_no',
        'material_name',
        'batch_serial_no',
        'supplier',
        'quantity_received',
        'unit_of_measure',
        'unit_price',
        'total_cost',
        'date_received',
        'date_inspected',
        'status',
        'remarks',
        'location',
        'name',
        'batch',
        'quantity',
        'unit',
        'unit_rate',
        'price',
        'total',
        'item_description',
        'archived',
        'category',
        'material_cost',
        'labor_cost',
        'unit_total',
        'item_total',
        'notes',
    ];

    protected $casts = [
        'date_received' => 'date',
        'date_inspected' => 'date',
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    /**
     * Get the purchase orders for this material.
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'material_id', 'id');
    }

    /**
     * Get the project record this material belongs to.
     */
    public function projectRecord()
    {
        return $this->belongsTo(ProjectRecord::class, 'project_record_id', 'id');
    }

    /**
     * Get the project this material belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
