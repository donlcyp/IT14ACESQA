<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $table = 'employee_attendance';

    protected $fillable = [
        'employee_id',
        'f_name',
        'l_name',
        'position',
        'attendance_status',
        'date',
        'time_in',
        'time_out',
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'time',
        'time_out' => 'time',
    ];

    /**
     * Get the employee this attendance record belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(EmployeeList::class, 'employee_id', 'id');
    }

    // Backward compatibility accessors
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
        // Employee code is not stored; use employee ID as fallback
        return 'EMP' . str_pad($this->employee_id, 3, '0', STR_PAD_LEFT);
    }

    public function getAttendanceDateAttribute()
    {
        return $this->date;
    }

    public function getStatusAttribute()
    {
        return $this->attendance_status;
    }
}
