<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QaRecord extends Model
{
    protected $fillable = [
        'title',
        'client',
        'inspector',
        'time',
        'color',
    ];
}
