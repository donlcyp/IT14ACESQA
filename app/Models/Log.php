<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $primaryKey = 'log_id';
    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'action',
        'log_date',
        'details',
    ];

    protected $casts = [
        'log_date' => 'datetime',
    ];

    /**
     * Get the user who performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
