<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'client_name',
        'client_prefix',
        'client_first_name',
        'client_last_name',
        'client_suffix',
        'status',
        'lead',
        'lead_prefix',
        'lead_first_name',
        'lead_last_name',
        'lead_suffix',
        'archived',
        'archive_reason',
        'archived_at',
    ];

    protected $appends = [
        'client_full_name',
        'lead_full_name',
    ];

    public function getClientFullNameAttribute(): string
    {
        return trim(collect([$this->client_prefix, $this->client_first_name, $this->client_last_name, $this->client_suffix])
            ->filter(fn ($segment) => $segment !== null && $segment !== '')
            ->implode(' '));
    }

    public function getLeadFullNameAttribute(): string
    {
        return trim(collect([$this->lead_prefix, $this->lead_first_name, $this->lead_last_name, $this->lead_suffix])
            ->filter(fn ($segment) => $segment !== null && $segment !== '')
            ->implode(' '));
    }

    /**
     * Get the project records associated with this project.
     */
    public function projectRecords()
    {
        return $this->hasMany(ProjectRecord::class);
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
}
