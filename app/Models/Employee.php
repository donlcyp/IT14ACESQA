<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    // Use the employee_list table from new schema
    protected $table = 'employee_list';

    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        'position',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
    ];

    public function getFullNameAttribute(): string
    {
        // Support both old and new schema field names
        $first = $this->f_name ?? $this->first_name ?? '';
        $last = $this->l_name ?? $this->last_name ?? '';
        return trim("{$first} {$last}");
    }

    /**
     * Get the user associated with this employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the projects this employee is assigned to.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_employees', 'employee_id', 'project_id')
            ->withPivot('role_title', 'salary', 'justification', 'assigned_from', 'assigned_to')
            ->withTimestamps();
    }

    /**
     * Backward compatibility: map old field names to new ones
     */
    public function getFirstNameAttribute()
    {
        return $this->f_name;
    }

    public function getLastNameAttribute()
    {
        return $this->l_name;
    }

    public function getEmployeeCodeAttribute()
    {
        // Generate employee code from ID
        return 'EMP' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }
}
