<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmployeeList extends Model
{
    use HasFactory;

    protected $table = 'employee_list';

    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        'position',
    ];

    /**
     * Get the user account for this employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the attendance records for this employee.
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(EmployeeAttendance::class, 'employee_id', 'id');
    }

    /**
     * Get the project manager role for this employee.
     */
    public function projMatManager(): HasMany
    {
        return $this->hasMany(ProjMatManage::class, 'employee_id', 'id');
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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->f_name} {$this->l_name}");
    }
}
