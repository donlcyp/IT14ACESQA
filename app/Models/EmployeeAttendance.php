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
        'punch_in_time',
        'punch_out_time',
        'is_late',
        'late_minutes',
        'grace_period_applied',
        'validation_status',
        'validated_by',
        'validation_notes',
        'validated_at',
        'rejection_reason',
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'datetime',
        'time_out' => 'datetime',
        'punch_in_time' => 'datetime',
        'punch_out_time' => 'datetime',
        'is_late' => 'boolean',
        'grace_period_applied' => 'boolean',
        'validated_at' => 'datetime',
    ];

    /**
     * Get the employee this attendance record belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(EmployeeList::class, 'employee_id', 'id');
    }

    /**
     * Get the HR/Timekeeper who validated this attendance
     */
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by', 'id');
    }

    /**
     * Get all validation records for this attendance
     */
    public function validations()
    {
        return $this->hasMany(AttendanceValidation::class, 'attendance_id', 'id');
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

    /**
     * Check if employee has punched in today
     */
    public function hasPunchedIn(): bool
    {
        return $this->punch_in_time !== null;
    }

    /**
     * Check if employee has punched out today
     */
    public function hasPunchedOut(): bool
    {
        return $this->punch_out_time !== null;
    }

    /**
     * Get punch status: 'Not Punched', 'Punched In', 'Punched Out'
     */
    public function getPunchStatus(): string
    {
        if ($this->hasPunchedOut()) {
            return 'Punched Out';
        }
        if ($this->hasPunchedIn()) {
            return 'Punched In';
        }
        return 'Not Punched';
    }

    /**
     * Get hours worked (if punched out)
     */
    public function getHoursWorked(): ?float
    {
        if (!$this->hasPunchedIn() || !$this->hasPunchedOut()) {
            return null;
        }
        $diff = $this->punch_out_time->diffInMinutes($this->punch_in_time);
        return round($diff / 60, 2);
    }

    /**
     * Check if attendance validation is pending
     */
    public function isPendingValidation(): bool
    {
        return $this->validation_status === 'pending';
    }

    /**
     * Check if attendance validation is approved
     */
    public function isValidationApproved(): bool
    {
        return $this->validation_status === 'approved';
    }

    /**
     * Check if attendance validation is rejected
     */
    public function isValidationRejected(): bool
    {
        return $this->validation_status === 'rejected';
    }

    /**
     * Get validation status label
     */
    public function getValidationStatusLabel(): string
    {
        return match($this->validation_status) {
            'pending' => 'Pending HR Review',
            'approved' => 'Approved by HR',
            'rejected' => 'Rejected',
            default => 'Unknown'
        };
    }

    /**
     * Approve attendance (by HR/Timekeeper)
     */
    public function approve(User $validator, ?string $notes = null): void
    {
        $this->update([
            'validation_status' => 'approved',
            'validated_by' => $validator->id,
            'validation_notes' => $notes,
            'validated_at' => now(),
            'attendance_status' => 'Present', // Mark as officially present after approval
        ]);
    }

    /**
     * Reject attendance (by HR/Timekeeper)
     */
    public function reject(User $validator, string $reason, ?string $notes = null): void
    {
        $this->update([
            'validation_status' => 'rejected',
            'validated_by' => $validator->id,
            'validation_notes' => $notes,
            'rejection_reason' => $reason,
            'validated_at' => now(),
            'attendance_status' => 'Absent', // Mark as absent if rejected
        ]);
    }
}
