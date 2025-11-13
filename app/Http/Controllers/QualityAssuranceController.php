<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectRecord;
use App\Models\Material;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;

class QualityAssuranceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Fetch records with optional search filtering
        $records = ProjectRecord::when($search, function ($query, $term) {
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('title', 'like', "%{$term}%")
                        ->orWhere('client', 'like', "%{$term}%")
                        ->orWhere('inspector', 'like', "%{$term}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Fetch materials for the materials section
        $materials = Material::orderBy('created_at', 'desc')->get();

        $usedProjectIds = ProjectRecord::whereNotNull('project_id')->pluck('project_id')->all();
        $usedProjectNames = ProjectRecord::whereNotNull('title')->pluck('title')->map(fn ($name) => trim($name))->filter()->unique()->values()->all();

        $availableProjectsQuery = Project::query()->orderBy('project_name');

        if (!empty($usedProjectIds)) {
            $availableProjectsQuery->whereNotIn('id', $usedProjectIds);
        }
        if (!empty($usedProjectNames)) {
            $availableProjectsQuery->whereNotIn('project_name', $usedProjectNames);
        }

        $availableProjects = $availableProjectsQuery->get();

        $selectedProject = null;
        if ($request->filled('project_id')) {
            $selectedProject = Project::find($request->query('project_id'));
            if ($selectedProject && $availableProjects->where('id', $selectedProject->id)->isEmpty()) {
                $availableProjects->prepend($selectedProject);
            }
        }

        $oldProjectId = old('project_id');
        if ($oldProjectId && (!$selectedProject || (int) $selectedProject->id !== (int) $oldProjectId)) {
            $oldProject = Project::find($oldProjectId);
            if ($oldProject) {
                $selectedProject = $oldProject;
                if ($availableProjects->where('id', $oldProject->id)->isEmpty()) {
                    $availableProjects->prepend($oldProject);
                }
            }
        }

        $selectedRecord = $selectedProject
            ? ProjectRecord::where('project_id', $selectedProject->id)->first()
            : null;

        $hasValidationErrors = session()->has('errors') && session('errors')->isNotEmpty();
        $shouldOpenModal = $request->boolean('open_modal')
            || $request->filled('project_id')
            || session('open_modal', false)
            || $hasValidationErrors;

        return view('project-material-management', [
            'records' => $records,
            'materials' => $materials,
            'availableProjects' => $availableProjects,
            'selectedProject' => $selectedProject,
            'shouldOpenModal' => (bool) $shouldOpenModal,
            'prefilledClientName' => optional($selectedProject)->client_name ?? optional($selectedRecord)->client,
            'prefilledInspector' => optional($selectedProject)->lead ?? optional($selectedRecord)->inspector,
            'selectedRecord' => $selectedRecord,
        ]);
    }

    public function show(ProjectRecord $project_record)
    {
        // Fetch materials for this specific QA record. If column not yet migrated, fall back to all.
        if (Schema::hasColumn('materials', 'project_record_id')) {
            $materials = Material::where('project_record_id', $project_record->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $materials = Material::orderBy('created_at', 'desc')->get();
        }
        
        return view('project-material-management-show', [
            'record' => $project_record,
            'materials' => $materials,
        ]);
    }

    public function destroy(ProjectRecord $project_record)
    {
        $project_record->delete();

        return redirect()->route('project-material-management')->with('success', 'Record deleted successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'time' => 'required|string',
            'color' => 'required|string',
        ]);

        $project = Project::findOrFail($validated['project_id']);

        ProjectRecord::updateOrCreate(
            ['project_id' => $project->id],
            [
                'title' => $project->project_name,
                'client' => $project->client_name,
                'inspector' => $project->lead,
                'time' => $validated['time'],
                'color' => $validated['color'],
            ]
        );

        return redirect()->route('project-material-management')->with('success', 'Project material record saved successfully.');
    }

    // Materials management methods
    public function storeMaterial(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_record_id' => 'required|exists:project_records,id',
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

            return redirect()->route('project-material-management-show', $validated['project_record_id'])->with('success', 'Material added successfully!');
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
                'project_record_id' => 'required|exists:project_records,id',
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

            return redirect()->route('project-material-management-show', $validated['project_record_id'])->with('success', 'Material updated successfully!');
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