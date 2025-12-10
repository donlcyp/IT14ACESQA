<?php

namespace App\Http\Controllers;

use App\Models\PositionDailyRate;
use Illuminate\Http\Request;

class PositionDailyRateController extends Controller
{
    /**
     * Display a listing of position daily rates.
     */
    public function index()
    {
        $rates = PositionDailyRate::orderBy('position')->get();
        return view('settings.salary-rates', ['rates' => $rates]);
    }

    /**
     * Store a newly created position daily rate.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|unique:position_daily_rates',
            'daily_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $validated['updated_by'] = auth()->id();

        PositionDailyRate::create($validated);

        return redirect()->route('settings.salary-rates')
            ->with('success', 'Position daily rate created successfully.');
    }

    /**
     * Update the specified position daily rate.
     */
    public function update(Request $request, PositionDailyRate $rate)
    {
        $validated = $request->validate([
            'position' => 'required|string|unique:position_daily_rates,position,' . $rate->id,
            'daily_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $validated['updated_by'] = auth()->id();

        $rate->update($validated);

        return redirect()->route('settings.salary-rates')
            ->with('success', 'Position daily rate updated successfully.');
    }

    /**
     * Delete the specified position daily rate.
     */
    public function destroy(PositionDailyRate $rate)
    {
        $rate->delete();

        return redirect()->route('settings.salary-rates')
            ->with('success', 'Position daily rate deleted successfully.');
    }
}
