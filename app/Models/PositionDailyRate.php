<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionDailyRate extends Model
{
    use HasFactory;

    protected $table = 'position_daily_rates';

    protected $fillable = [
        'position',
        'daily_rate',
        'description',
        'updated_by',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
    ];

    /**
     * Get the user who last updated this rate.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
