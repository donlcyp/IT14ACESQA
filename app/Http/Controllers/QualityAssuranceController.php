<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QaRecord;

class QualityAssuranceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Fetch records with optional search filtering
        $records = $search
            ? QaRecord::where('title', 'like', "%$search%")
                ->orWhere('client', 'like', "%$search%")
                ->orWhere('inspector', 'like', "%$search%")
                ->get()
            : QaRecord::all();

        return view('quality-assurance', compact('records'));
    }

    public function show(QaRecord $qa_record)
    {
        // In a future iteration, fetch related materials for this record.
        return view('quality-assurance-show', [
            'record' => $qa_record,
        ]);
    }

    public function destroy(QaRecord $qa_record)
    {
        $qa_record->delete();

        return redirect()->route('quality-assurance')->with('success', 'Record deleted successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'inspector' => 'required|string|max:255',
            'time' => 'required|string',
            'color' => 'required|string',
        ]);

        QaRecord::create($validated);

        return redirect()->route('quality-assurance')->with('success', 'Record created successfully.');
    }
}