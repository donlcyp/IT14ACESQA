<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'project_name',
        'description',
        'location',
        'industry',
        'date_started',
        'date_ended',
        'target_timeline',
        'assigned_pm_id',
        'client_id',
        'client_prefix',
        'client_first_name',
        'client_last_name',
        'client_suffix',
        'allocated_amount',
        'used_amount',
        'status',
        'note_remarks',
        'pm_status',
        'archived',
        'archived_at',
        'archive_reason',
    ];

    protected $casts = [
        'date_started' => 'date',
        'date_ended' => 'date',
        'target_timeline' => 'date',
        'allocated_amount' => 'decimal:2',
        'used_amount' => 'decimal:2',
        'archived' => 'boolean',
    ];

    /**
     * Get the project manager assigned to this project.
     */
    public function assignedPM(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_pm_id', 'id');
    }

    /**
     * Get the client for this project.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * Get the purchase orders for this project.
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'project_id', 'id');
    }

    /**
     * Get the materials for this project.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'project_id', 'id');
    }

    /**
     * Get the project material managers for this project.
     */
    public function projMatManagers(): HasMany
    {
        return $this->hasMany(ProjMatManage::class, 'project_id', 'id');
    }

    /**
     * Get the project records for this project.
     */
    public function projectRecords(): HasMany
    {
        return $this->hasMany(ProjectRecord::class, 'project_id', 'id');
    }

    /**
     * Get the employees assigned to this project.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'project_employees', 'project_id', 'employee_id')
            ->withPivot('role_title', 'salary', 'justification', 'assigned_from', 'assigned_to')
            ->withTimestamps();
    }

    /**
     * Get the project documents for this project.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class, 'project_id', 'id');
    }

    /**
     * Get the project updates for this project.
     */
    public function updates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class, 'project_id', 'id')->orderBy('created_at', 'desc');
    }

    /**
     * Backward compatibility accessors for old schema field names
     */
    public function getProjectNameAttribute()
    {
        return $this->attributes['project_name'] ?? $this->project_code;
    }

    public function getClientNameAttribute()
    {
        return $this->client?->company_name ?? 'N/A';
    }

    public function getLeadAttribute()
    {
        return $this->assignedPM?->name ?? 'N/A';
    }
}
