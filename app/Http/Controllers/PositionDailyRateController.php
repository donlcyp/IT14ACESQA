<?php

namespace App\Http\Controllers;

use App\Models\PositionDailyRate;
use App\Models\Log;
use Illuminate\Http\Request;

class PositionDailyRateController extends Controller
{
    /**
     * Display the salary settings page
     */
    public function index()
    {
        $rates = PositionDailyRate::orderBy('daily_rate', 'desc')->get();
        
        return view('settings.salary-rates', compact('rates'));
    }

    /**
     * Update a position's daily rate
     */
    public function update(Request $request, PositionDailyRate $rate)
    {
        $request->validate([
            'daily_rate' => 'required|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|max:500',
        ]);

        $oldRate = $rate->daily_rate;
        
        $rate->update([
            'daily_rate' => $request->daily_rate,
            'description' => $request->description,
            'updated_by' => auth()->id(),
        ]);

        // Log the change
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Daily Rate',
            'details' => "Updated {$rate->position} daily rate from ₱" . number_format($oldRate, 2) . " to ₱" . number_format($request->daily_rate, 2),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('settings.salary-rates')
            ->with('success', "Daily rate for {$rate->position} updated successfully to ₱" . number_format($request->daily_rate, 2));
    }

    /**
     * Store a new position rate
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:100|unique:position_daily_rates,position',
            'daily_rate' => 'required|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|max:500',
        ]);

        $rate = PositionDailyRate::create([
            'position' => $request->position,
            'daily_rate' => $request->daily_rate,
            'description' => $request->description,
            'updated_by' => auth()->id(),
        ]);

        // Log the change
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Created Daily Rate',
            'details' => "Created new position rate: {$rate->position} at ₱" . number_format($request->daily_rate, 2),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('settings.salary-rates')
            ->with('success', "New position {$rate->position} added with daily rate of ₱" . number_format($request->daily_rate, 2));
    }

    /**
     * Delete a position rate
     */
    public function destroy(Request $request, PositionDailyRate $rate)
    {
        $positionName = $rate->position;
        
        // Log the deletion
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted Daily Rate',
            'details' => "Deleted position rate: {$positionName} (was ₱" . number_format($rate->daily_rate, 2) . ")",
            'ip_address' => $request->ip(),
        ]);

        $rate->delete();

        return redirect()->route('settings.salary-rates')
            ->with('success', "Position {$positionName} has been removed.");
    }

    /**
     * Get rates as JSON (for API use)
     */
    public function getRates()
    {
        return response()->json(PositionDailyRate::getRatesArray());
    }
}
