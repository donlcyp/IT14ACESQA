<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QaRecord;
use App\Models\Material;

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

        // Fetch materials for the materials section
        $materials = Material::orderBy('created_at', 'desc')->get();

        return view('quality-assurance', compact('records', 'materials'));
    }

    public function show(QaRecord $qa_record)
    {
        // Fetch materials for this specific QA record
        // For now, we'll show all materials, but in the future this could be filtered by project/record
        $materials = Material::orderBy('created_at', 'desc')->get();
        
        return view('quality-assurance-show', [
            'record' => $qa_record,
            'materials' => $materials,
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

    // Materials management methods
    public function storeMaterial(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'batch' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:0',
                'unit' => 'nullable|string|max:50',
                'price' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'date_received' => 'nullable|date',
                'date_inspected' => 'nullable|date',
                'status' => 'nullable|string|max:50',
                'location' => 'nullable|string|max:255',
            ]);

            // Set default status to 'Pending' if not provided
            if (empty($validated['status'])) {
                $validated['status'] = 'Pending';
            }

            Material::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material added successfully!'
                ]);
            }

            return redirect()->route('quality-assurance')->with('success', 'Material added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving the material'
                ], 500);
            }
            throw $e;
        }
    }

    public function updateMaterial(Request $request, $id)
    {
        try {
            $material = Material::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'batch' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:0',
                'unit' => 'nullable|string|max:50',
                'price' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'date_received' => 'nullable|date',
                'date_inspected' => 'nullable|date',
                'status' => 'required|string|max:50',
                'location' => 'nullable|string|max:255',
            ]);

            $material->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material updated successfully!'
                ]);
            }

            return redirect()->route('quality-assurance')->with('success', 'Material updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the material'
                ], 500);
            }
            throw $e;
        }
    }

    public function destroyMaterial(Request $request, $id)
    {
        try {
            $material = Material::findOrFail($id);
            $material->delete();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material deleted successfully!'
                ]);
            }

            return redirect()->route('quality-assurance')->with('success', 'Material deleted successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while deleting the material'
                ], 500);
            }
            throw $e;
        }
    }
}