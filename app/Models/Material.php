<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'batch',
        'supplier',
        'quantity',
        'unit',
        'price',
        'total',
        'date_received',
        'date_inspected',
        'status',
        'location',
    ];
}
