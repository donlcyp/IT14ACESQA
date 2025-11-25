<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialData extends Model
{
    protected $fillable = [
        'year',
        'month',
        'revenue',
        'expenses',
    ];

    protected $casts = [
        'revenue' => 'decimal:2',
        'expenses' => 'decimal:2',
    ];
}
