<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->f_name} {$this->l_name}");
    }
}
