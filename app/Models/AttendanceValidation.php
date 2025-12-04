<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceValidation extends Model
{
    use HasFactory;

    protected $table = 'attendance_validations';

    protected $fillable = [
        'attendance_id',
        'employee_id',
        'validated_by',
        'validation_status',
        'validation_notes',
        'rejection_reason',
        'validated_at',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the attendance record being validated
     */
    public function attendance(): BelongsTo
    {
        return $this->belongsTo(EmployeeAttendance::class, 'attendance_id');
    }

    /**
     * Get the employee associated with this validation
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(EmployeeList::class, 'employee_id');
    }

    /**
     * Get the HR/Timekeeper who validated this record
     */
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * Scope to get pending validations
     */
    public function scopePending($query)
    {
        return $query->where('validation_status', 'pending');
    }

    /**
     * Scope to get approved validations
     */
    public function scopeApproved($query)
    {
        return $query->where('validation_status', 'approved');
    }

    /**
     * Scope to get rejected validations
     */
    public function scopeRejected($query)
    {
        return $query->where('validation_status', 'rejected');
    }

    /**
     * Check if this validation is pending
     */
    public function isPending(): bool
    {
        return $this->validation_status === 'pending';
    }

    /**
     * Check if this validation is approved
     */
    public function isApproved(): bool
    {
        return $this->validation_status === 'approved';
    }

    /**
     * Check if this validation is rejected
     */
    public function isRejected(): bool
    {
        return $this->validation_status === 'rejected';
    }
}
