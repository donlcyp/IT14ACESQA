<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'first_name',
        'last_name',
        'position',
        'education_level',
        'document_path',
        'email',
        'phone',
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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
