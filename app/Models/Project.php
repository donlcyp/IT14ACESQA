<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EmployeeList;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'project_name',
        'description',
        'location',
        'industry',
        'project_type',
        'date_started',
        'date_ended',
        'target_timeline',
        'assigned_pm_id',
        'client_id',
        'client_first_name',
        'client_last_name',
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
        return $this->belongsToMany(EmployeeList::class, 'project_employees', 'project_id', 'employee_id')
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
        // Prefer the related Client's company_name when available
        if ($this->client && !empty($this->client->company_name)) {
            return $this->client->company_name;
        }

        // Fallback to the snapshot fields stored on the projects table
        $fullName = trim(($this->client_first_name ?? '') . ' ' . ($this->client_last_name ?? ''));

        return $fullName !== '' ? $fullName : 'N/A';
    }

    public function getLeadAttribute()
    {
        return $this->assignedPM?->name ?? 'N/A';
    }

    /**
     * Calculate total material cost (Material Cost + Labor Cost) for all materials in project
     */
    public function calculateTotalMaterialCost(): float
    {
        return $this->materials()
            ->get()
            ->sum(function ($material) {
                $materialCost = ($material->material_cost ?? 0) * ($material->quantity ?? 0);
                $laborCost = ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                return $materialCost + $laborCost;
            });
    }

    /**
     * Get the effective amount used (from materials if available, otherwise from used_amount field)
     */
    public function getEffectiveUsedAmount(): float
    {
        $materialsTotal = $this->calculateTotalMaterialCost();
        return $materialsTotal > 0 ? $materialsTotal : ($this->used_amount ?? 0);
    }

}

