<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Material;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::where('archived', false)
            ->with('client', 'assignedPM')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $clients = \App\Models\Client::all();
        $projectManagers = \App\Models\Employee::where('position', 'Project Manager')
            ->with('user')
            ->get()
            ->map(function ($employee) {
                return (object)[
                    'id' => $employee->user_id,
                    'name' => $employee->user->name ?? ($employee->f_name . ' ' . $employee->l_name),
                ];
            });

        // Get all employees with their current project assignments
        $allEmployees = Employee::all()->map(function ($employee) {
            $assignedProject = $employee->projects()->first();
            $employee->assigned_to_other_project = $assignedProject && $assignedProject->status !== 'Completed';
            
            return $employee;
        })->toArray();
        
        // Build project-employees mapping
        $projectEmployees = [];
        foreach ($projects as $project) {
            $projectEmployees[$project->id] = $project->employees->pluck('id')->toArray();
        }

        return view('projects', compact('projects', 'clients', 'projectManagers', 'allEmployees', 'projectEmployees'));
    }

    public function show(Project $project)
    {
        $project->load(['client', 'assignedPM', 'projectRecords.materials', 'employees', 'materials']);

        // Get all employees with their current project assignments
        $allEmployees = Employee::all()->map(function ($employee) {
            $assignedProject = $employee->projects()->first();
            $employee->assigned_to_other_project = $assignedProject && $assignedProject->status !== 'Completed';
            
            return $employee;
        });
        
        // Build project-employees mapping
        $projectEmployees = [$project->id => $project->employees->pluck('id')->toArray()];

        return view('projects-view', compact('project', 'allEmployees', 'projectEmployees'));
    }

    /**
     * Get project data for API/AJAX requests
     */
    public function getProject(Project $project)
    {
        return response()->json($project);
    }

    // PM recommends completion (records timestamp). Only role PM can trigger.
    public function recommendCompletion(Project $project)
    {
        $user = auth()->user();
        if (!$user || !in_array($user->role, ['PM'])) {
            abort(403);
        }

        // Only allow recommend when project is Ongoing
        if ($project->status !== 'Ongoing' && $project->status !== 'On Track') {
            return redirect()->back()->with('error', 'Recommendation is allowed only when project is Ongoing.');
        }

        $project->update([
            'pm_confirmed_at' => now(),
        ]);

        return redirect()->route('projects')->with('success', 'Completion recommended by PM.');
    }

    // Owner approves to move project from Under Review to Ongoing (start work)
    public function approve(Project $project)
    {
        $user = auth()->user();
        if (!$user || !in_array($user->role, ['Owner'])) {
            abort(403);
        }

        if ($project->status === 'Completed') {
            return redirect()->back()->with('error', 'Project already completed.');
        }

        // Move to Ongoing and stamp start_date if empty
        $project->update([
            'status' => 'Ongoing',
            'start_date' => $project->start_date ?: now()->toDateString(),
        ]);

        return redirect()->route('projects')->with('success', 'Project approved and set to Ongoing.');
    }

    // Owner completes project after PM recommendation and materials clearance
    public function complete(Project $project)
    {
        $user = auth()->user();
        if (!$user || !in_array($user->role, ['Owner'])) {
            abort(403);
        }

        // Require PM recommendation
        if (empty($project->pm_confirmed_at)) {
            return redirect()->back()->with('error', 'PM recommendation is required before completion.');
        }

        // Check materials clearance: all materials for the project must be Approved or Failed
        $materials = Material::whereHas('purchaseOrders', function($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();

        $blockers = $materials->where('status', '!=', 'Approved')
            ->where('status', '!=', 'Fail')
            ->count();
        
        if ($blockers > 0) {
            return redirect()->back()->with('error', 'Not all materials are cleared (Approved/Failed).');
        }

        // Mark completed
        $project->update([
            'status' => 'Completed',
            'completed_date' => now()->toDateString(),
        ]);

        return redirect()->route('projects')->with('success', 'Project marked as Completed by Owner.');
    }

    public function archives()
    {
        $projects = Project::where('archived', true)
            ->with(['employees'])
            ->orderByDesc('archived_at')
            ->paginate(10)
            ->withQueryString();

        return view('archives', compact('projects'));
    }

    public function archive(Request $request, Project $project)
    {
        $validated = $request->validate([
            'archive_reason' => ['required', 'string', 'in:Finished,Cancelled'],
        ]);

        $project->update([
            'archived' => true,
            'archive_reason' => $validated['archive_reason'],
            'archived_at' => now(),
        ]);

        return redirect()->route('projects')->with('success', 'Project archived successfully.');
    }

    public function unarchive(Project $project)
    {
        $project->update([
            'archived' => false,
            'archive_reason' => null,
            'archived_at' => null,
        ]);

        return redirect()->route('projects')->with('success', 'Project restored successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_code'     => ['nullable', 'string', 'max:255', 'unique:projects,project_code'],
            'project_name'     => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:1000'],
            'location'         => ['nullable', 'string', 'max:255'],
            'industry'         => ['nullable', 'string', 'max:255'],
            'target_timeline'  => ['nullable', 'date'],
            'allocated_amount' => ['nullable', 'numeric', 'min:0'],
            'client_first_name' => ['required', 'string', 'max:255'],
            'client_last_name' => ['required', 'string', 'max:255'],
            'assigned_pm_id'   => ['nullable', 'exists:users,id'],
        ]);

        // Create or get client
        $clientName = trim(
            $validated['client_first_name'] . ' ' .
            $validated['client_last_name']
        );
        
        $client = \App\Models\Client::firstOrCreate(
            ['company_name' => $clientName],
            [
                'company_name' => $clientName,
                'contact_person' => $validated['client_first_name'] . ' ' . $validated['client_last_name'],
            ]
        );

        // Auto-generate project code if not provided
        if (empty($validated['project_code'])) {
            $validated['project_code'] = $this->generateProjectCode();
        }

        // Create project
        $project = \App\Models\Project::create([
            'project_code'     => $validated['project_code'],
            'project_name'     => $validated['project_name'],
            'description'      => $validated['description'] ?? null,
            'location'         => $validated['location'] ?? null,
            'industry'         => $validated['industry'] ?? null,
            'date_started'     => null,
            'date_ended'       => null,
            'target_timeline'  => $validated['target_timeline'] ?? null,
            'allocated_amount' => $validated['allocated_amount'] ?? 0,
            'used_amount'      => 0,
            'status'           => 'Ongoing',
            'note_remarks'     => null,
            'pm_status'        => null,
            'client_id'        => $client->id,
            'client_first_name' => $validated['client_first_name'],
            'client_last_name' => $validated['client_last_name'],
            'assigned_pm_id'   => $validated['assigned_pm_id'] ?? null,
        ]);

        // Automatically create a ProjMatManage (project material management entry)
        \App\Models\ProjMatManage::create([
            'project_id' => $project->id,
            'client_id' => $client->id,
            'employee_id' => null,
        ]);

        // Automatically create a ProjectRecord (for project material management display)
        \App\Models\ProjectRecord::create([
            'project_id' => $project->id,
            'title' => $validated['project_name'],
            'client' => $clientName,
            'inspector' => auth()->user()->name ?? 'Unknown',
            'time' => now()->format('H:i:s'),
            'color' => '#16a34a',
        ]);

        return redirect()
            ->route('project-material-management', [
                'project_id' => $project->id,
                'open_modal' => 1,
            ])
            ->with('success', 'Project added successfully! Project record created in material management.');
    }

    private function generateProjectCode(): string
    {
        $latest = Project::latest('id')->value('project_code');

        if (!$latest) {
            return 'PROJ-001';
        }

        // Extract numeric part from code like "PROJ-001"
        $matches = [];
        preg_match('/(\d+)$/', $latest, $matches);
        
        if (!empty($matches[1])) {
            $numeric = (int) $matches[1] + 1;
            return 'PROJ-' . str_pad($numeric, 3, '0', STR_PAD_LEFT);
        }

        return 'PROJ-001';
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'location' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'target_timeline' => ['nullable', 'date'],
            'allocated_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:Ongoing,Completed'],
            'assigned_pm_id' => ['nullable', 'exists:users,id'],
        ]);

        $project->update([
            'project_name' => $validated['project_name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'] ?? null,
            'industry' => $validated['industry'] ?? null,
            'target_timeline' => $validated['target_timeline'] ?? null,
            'allocated_amount' => $validated['allocated_amount'] ?? null,
            'status' => $validated['status'],
            'assigned_pm_id' => $validated['assigned_pm_id'] ?? null,
        ]);

        return redirect()->route('projects')->with('success', 'Project updated successfully.');
    }

    /**
     * Store a project document (image upload)
     */
    public function storeDocument(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        try {
            // Store the file
            $file = $request->file('image');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('projects/' . $project->id, $fileName, 'public');

            // Create document record
            \App\Models\ProjectDocument::create([
                'project_id' => $project->id,
                'title' => $validated['title'],
                'file_path' => $filePath,
                'file_name' => $fileName,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'uploaded_by' => auth()->user()->id,
            ]);

            return redirect()->route('projects.show', $project->id)->with('success', 'Image uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to upload image: ' . $e->getMessage());
        }
    }

    /**
     * Delete a project document
     */
    public function deleteDocument(Project $project, \App\Models\ProjectDocument $document)
    {
        if ($document->project_id !== $project->id) {
            abort(403, 'Unauthorized');
        }

        // Delete the file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        // Delete the database record
        $document->delete();

        return redirect()->route('projects.show', $project->id)->with('success', 'Image deleted successfully!');
    }

    /**
     * Store a project update
     */
    public function storeUpdate(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ]);

        try {
            \App\Models\ProjectUpdate::create([
                'project_id' => $project->id,
                'updated_by' => auth()->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => 'In Progress', // Default status
            ]);

            return redirect()->route('projects.show', $project->id)->with('success', 'Project update added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to add update: ' . $e->getMessage());
        }
    }

    /**
     * Store a material for the project
     */
    public function storeMaterial(Request $request, Project $project)
    {
        $validated = $request->validate([
            'item_description' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:50',
            'unit_rate' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,approved,failed',
        ]);

        try {
            Material::create([
                'project_id' => $project->id,
                'item_description' => $validated['item_description'],
                'quantity' => $validated['quantity'],
                'unit' => $validated['unit'],
                'unit_rate' => $validated['unit_rate'],
                'status' => $validated['status'] ?? 'pending',
            ]);

            return redirect()->route('projects.show', $project->id)->with('success', 'Material added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to add material: ' . $e->getMessage());
        }
    }

    /**
     * Update a material for the project
     */
    public function updateMaterial(Request $request, Project $project, Material $material)
    {
        if ($material->project_id !== $project->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'item_description' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:50',
            'unit_rate' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,approved,failed',
        ]);

        try {
            $material->update([
                'item_description' => $validated['item_description'],
                'quantity' => $validated['quantity'],
                'unit' => $validated['unit'],
                'unit_rate' => $validated['unit_rate'],
                'status' => $validated['status'] ?? 'pending',
            ]);

            return redirect()->route('projects.show', $project->id)->with('success', 'Material updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to update material: ' . $e->getMessage());
        }
    }

    /**
     * Delete a material from the project
     */
    public function deleteMaterial(Project $project, Material $material)
    {
        if ($material->project_id !== $project->id) {
            abort(403, 'Unauthorized');
        }

        try {
            $material->delete();
            return redirect()->route('projects.show', $project->id)->with('success', 'Material deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to delete material: ' . $e->getMessage());
        }
    }

    /**
     * Get a single material for editing
     */
    public function getMaterial(Project $project, Material $material)
    {
        if ($material->project_id !== $project->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json($material);
    }

    /**
     * Assign an employee to a project
     */
    public function assignEmployee(Request $request, Project $project)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employee_list,id',
            'role_title' => 'required|string|max:255',
            'assigned_from' => 'nullable|date',
            'assigned_to' => 'nullable|date',
        ]);

        try {
            $project->employees()->attach($validated['employee_id'], [
                'role_title' => $validated['role_title'],
                'assigned_from' => $validated['assigned_from'] ?? now(),
                'assigned_to' => $validated['assigned_to'] ?? null,
            ]);

            return redirect()->route('projects.show', $project->id)->with('success', 'Employee assigned successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to assign employee: ' . $e->getMessage());
        }
    }

    /**
     * Remove an employee from a project
     */
    public function removeEmployee(Project $project, $employee)
    {
        try {
            $project->employees()->detach($employee);
            return redirect()->route('projects.show', $project->id)->with('success', 'Employee removed successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to remove employee: ' . $e->getMessage());
        }
    }
}
