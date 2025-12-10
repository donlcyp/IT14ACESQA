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
     * Get the user who last updated this rate
     */
    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get all rates as a key-value array (position => daily_rate)
     */
    public static function getRatesArray(): array
    {
        return self::pluck('daily_rate', 'position')->toArray();
    }

    /**
     * Get daily rate for a specific position
     */
    public static function getRateForPosition(string $position, float $default = 700.00): float
    {
        $rate = self::where('position', $position)->first();
        return $rate ? (float) $rate->daily_rate : $default;
    }

    /**
     * Get hourly rate for a specific position (daily rate / 8 hours)
     */
    public static function getHourlyRateForPosition(string $position, float $default = 700.00): float
    {
        $dailyRate = self::getRateForPosition($position, $default);
        return round($dailyRate / EmployeeAttendance::STANDARD_HOURS_PER_DAY, 2);
    }

    /**
     * Update rate for a position (creates if doesn't exist)
     */
    public static function setRate(string $position, float $dailyRate, ?int $userId = null, ?string $description = null): self
    {
        return self::updateOrCreate(
            ['position' => $position],
            [
                'daily_rate' => $dailyRate,
                'updated_by' => $userId,
                'description' => $description,
            ]
        );
    }
}
