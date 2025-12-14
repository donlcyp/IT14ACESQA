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
        // QA Inspection fields
        'qa_status',
        'qa_inspected_by',
        'qa_inspected_at',
        'qa_remarks',
        'qa_rating',
        'qa_checklist',
        'failure_reason',
        'needs_replacement',
        'qa_decision_at',
        // Replacement request fields
        'replacement_requested',
        'replacement_requested_at',
        'replacement_requested_by',
        'replacement_reason',
        'replacement_status',
        'replacement_approved_at',
        'replacement_approved_by',
        'replacement_notes',
    ];

    protected $casts = [
        'date_received' => 'date',
        'date_inspected' => 'date',
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'quantity' => 'integer',
        'quantity_received' => 'integer',
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'unit_rate' => 'decimal:2',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'unit_total' => 'decimal:2',
        'item_total' => 'decimal:2',
        // QA fields casts
        'qa_inspected_at' => 'datetime',
        'qa_checklist' => 'array',
        'qa_rating' => 'integer',
        'needs_replacement' => 'boolean',
        'qa_decision_at' => 'datetime',
        // Replacement fields casts
        'replacement_requested' => 'boolean',
        'replacement_requested_at' => 'datetime',
        'replacement_approved_at' => 'datetime',
    ];

    /**
     * Get the QA inspector who inspected this material.
     */
    public function qaInspector()
    {
        return $this->belongsTo(User::class, 'qa_inspected_by');
    }

    /**
     * Get the user who requested replacement.
     */
    public function replacementRequester()
    {
        return $this->belongsTo(User::class, 'replacement_requested_by');
    }

    /**
     * Get the user who approved replacement.
     */
    public function replacementApprover()
    {
        return $this->belongsTo(User::class, 'replacement_approved_by');
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
