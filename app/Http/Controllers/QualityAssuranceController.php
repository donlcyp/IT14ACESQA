<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Project;

class QualityAssuranceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Fetch project records with optional search filtering
        $records = \App\Models\ProjectRecord::when($search, function ($query, $term) {
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('title', 'like', "%{$term}%")
                        ->orWhere('client', 'like', "%{$term}%")
                        ->orWhere('inspector', 'like', "%{$term}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Fetch all projects for reference
        $projects = Project::orderBy('project_code')->get();

        $selectedProject = null;
        if ($request->filled('project_id')) {
            $selectedProject = Project::find($request->query('project_id'));
            if ($selectedProject && $projects->where('id', $selectedProject->id)->isEmpty()) {
                $projects->prepend($selectedProject);
            }
        }

        $oldProjectId = old('project_id');
        if ($oldProjectId && (!$selectedProject || (int) $selectedProject->id !== (int) $oldProjectId)) {
            $oldProject = Project::find($oldProjectId);
            if ($oldProject) {
                $selectedProject = $oldProject;
                if ($projects->where('id', $oldProject->id)->isEmpty()) {
                    $projects->prepend($oldProject);
                }
            }
        }

        $hasValidationErrors = session()->has('errors') && session('errors')->isNotEmpty();
        $shouldOpenModal = $request->boolean('open_modal')
            || $request->filled('project_id')
            || session('open_modal', false)
            || $hasValidationErrors;

        return view('project-material-management', [
            'records' => $records,
            'materials' => $records,
            'availableProjects' => $projects,
            'selectedProject' => $selectedProject,
            'shouldOpenModal' => (bool) $shouldOpenModal,
        ]);
    }

    public function show($id)
    {
        // Fetch the project record
        $record = \App\Models\ProjectRecord::findOrFail($id);
        
        // Fetch materials for this project record
        $materials = Material::where('project_record_id', $record->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('project-material-management-show', [
            'record' => $record,
            'materials' => $materials,
        ]);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('project-material-management')->with('success', 'Material deleted successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'color' => 'nullable|string|max:7',
            'material_name' => 'nullable|string|max:255',
            'batch_serial_no' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
            'quantity_received' => 'nullable|integer|min:0',
            'unit_of_measure' => 'nullable|string|max:50',
            'unit_price' => 'nullable|numeric|min:0',
            'total_cost' => 'nullable|numeric|min:0',
            'date_received' => 'nullable|date',
            'date_inspected' => 'nullable|date',
            'status' => 'nullable|string|in:Pending,Approved,Fail',
            'remarks' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        // Update the ProjMatManage record with color if provided
        if (!empty($validated['color'])) {
            \App\Models\ProjMatManage::where('project_id', $validated['project_id'])
                ->update(['color' => $validated['color']]);
        }

        // Only create Material if material_name is provided
        if (!empty($validated['material_name'])) {
            Material::create($validated);
        }

        return redirect()->route('project-material-management')->with('success', 'Project material record saved successfully.');
    }

    // Materials management methods
    public function storeMaterial(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_record_id' => 'nullable|exists:project_records,id',
                'project_id' => 'nullable|exists:projects,id',
                'material_name' => 'required|string|max:255',
                'name' => 'nullable|string|max:255',
                'batch_serial_no' => 'nullable|string|max:255',
                'batch' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'quantity_received' => 'nullable|integer|min:0',
                'quantity' => 'nullable|numeric|min:0',
                'unit_of_measure' => 'nullable|string|max:50',
                'unit' => 'nullable|string|max:50',
                'unit_price' => 'nullable|numeric|min:0',
                'price' => 'nullable|numeric|min:0',
                'total_cost' => 'nullable|numeric|min:0',
                'total' => 'nullable|numeric|min:0',
                'date_received' => 'nullable|date',
                'date_inspected' => 'nullable|date',
                'status' => 'nullable|string|in:Pending,Approved,Fail',
                'remarks' => 'nullable|string',
                'location' => 'nullable|string|max:255',
            ]);

            // Normalize field names (support both old and new naming conventions)
            if (empty($validated['material_name']) && !empty($validated['name'])) {
                $validated['material_name'] = $validated['name'];
            }
            if (empty($validated['batch_serial_no']) && !empty($validated['batch'])) {
                $validated['batch_serial_no'] = $validated['batch'];
            }
            if (empty($validated['quantity_received']) && !empty($validated['quantity'])) {
                $validated['quantity_received'] = $validated['quantity'];
            }
            if (empty($validated['unit_of_measure']) && !empty($validated['unit'])) {
                $validated['unit_of_measure'] = $validated['unit'];
            }
            if (empty($validated['unit_price']) && !empty($validated['price'])) {
                $validated['unit_price'] = $validated['price'];
            }
            if (empty($validated['total_cost']) && !empty($validated['total'])) {
                $validated['total_cost'] = $validated['total'];
            }

            // Set default status to 'Pending' (idle) if not provided
            if (empty($validated['status'])) {
                $validated['status'] = 'Pending';
            }

            // Require remarks when status is Fail
            if (($validated['status'] ?? null) === 'Fail' && empty($validated['remarks'])) {
                return back()
                    ->withErrors(['remarks' => 'Remarks are required when marking material as Failed.'])
                    ->withInput();
            }

            Material::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material added successfully!'
                ]);
            }

            return redirect()->route('project-material-management')->with('success', 'Material added successfully!');
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
                    'message' => 'An error occurred while saving the material: ' . $e->getMessage()
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
                'material_name' => 'required|string|max:255',
                'batch_serial_no' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'quantity_received' => 'required|integer|min:0',
                'unit_of_measure' => 'nullable|string|max:50',
                'unit_price' => 'required|numeric|min:0',
                'total_cost' => 'required|numeric|min:0',
                'date_received' => 'nullable|date',
                'date_inspected' => 'nullable|date',
                'status' => 'required|string|in:Pending,Approved,Fail',
                'remarks' => 'nullable|string',
                'location' => 'nullable|string|max:255',
            ]);

            if (($validated['status'] ?? null) === 'Fail' && empty($validated['remarks'])) {
                return back()
                    ->withErrors(['remarks' => 'Remarks are required when marking material as Failed.'])
                    ->withInput();
            }

            $material->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material updated successfully!'
                ]);
            }

            return redirect()->route('project-material-management')->with('success', 'Material updated successfully!');
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

            return redirect()->route('project-material-management')->with('success', 'Material deleted successfully!');
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