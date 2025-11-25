<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceHistory extends Model
{
    protected $table = 'attendance_history';

    protected $fillable = [
        'employee_id',
        'employee_code',
        'first_name',
        'last_name',
        'position',
        'status',
        'attendance_date',
        'time_in',
        'time_out',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
