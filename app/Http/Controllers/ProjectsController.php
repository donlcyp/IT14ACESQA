<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Material;
use App\Models\EmployeeList;
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
        $projectManagers = \App\Models\User::where('role', 'PM')
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                return (object)[
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            })
            ->values();

        // Get all employees with their current project assignments
        $allEmployees = EmployeeList::all()->map(function ($employee) {
            $assignedProject = $employee->projects()->first();
            return [
                'id' => $employee->id,
                'f_name' => $employee->f_name,
                'l_name' => $employee->l_name,
                'position' => $employee->position,
                'assigned_to_other_project' => $assignedProject && $assignedProject->status !== 'Completed'
            ];
        })->values()->toArray();
        
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
        $allEmployees = EmployeeList::query()->get()->map(function ($employee) {
            $assignedProject = $employee->projects()->where('status', '!=', 'Completed')->first();
            return [
                'id' => (int) $employee->id,
                'f_name' => $employee->f_name ?? '',
                'l_name' => $employee->l_name ?? '',
                'position' => $employee->position ?? 'Staff',
                'assigned_to_other_project' => $assignedProject !== null
            ];
        })->values()->toArray();
        
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
        $materials = Material::where('project_id', $project->id)->get();

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
            'project_type'     => ['required', 'in:Plumbing Works,Fire Safety,Fire Detection Alarm System,Gas Line Installation,Air-Conditioning System Installation & Maintenance,Ducting Works'],
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
            'project_type'     => $validated['project_type'],
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
            'color' => '#1e40af',
        ]);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Project added successfully!');
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
            'date_started' => ['nullable', 'date'],
            'date_ended' => ['nullable', 'date', 'after_or_equal:date_started'],
            'allocated_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:Ongoing,Completed'],
            'assigned_pm_id' => ['nullable', 'exists:users,id'],
        ], [
            'date_ended.after_or_equal' => 'Date Ended must be on or after Date Started.',
        ]);

        // Check if project status is locked (already Completed)
        if ($project->status === 'Completed' && $validated['status'] !== 'Completed') {
            return redirect()->back()->with('error', 'Project status is locked. Completed projects cannot be changed to Ongoing.');
        }

        $project->update([
            'project_name' => $validated['project_name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'] ?? null,
            'industry' => $validated['industry'] ?? null,
            'target_timeline' => $validated['target_timeline'] ?? null,
            'date_started' => $validated['date_started'] ?? null,
            'date_ended' => $validated['date_ended'] ?? null,
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
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,zip|max:51200', // 50MB per file
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        try {
            // Handle single image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('projects/' . $project->id, $fileName, 'public');

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
            }

            // Handle multiple file upload
            if ($request->hasFile('attachments')) {
                $files = $request->file('attachments');
                $uploadedCount = 0;

                foreach ($files as $file) {
                    $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $filePath = $file->storeAs('projects/' . $project->id, $fileName, 'public');

                    \App\Models\ProjectDocument::create([
                        'project_id' => $project->id,
                        'title' => $validated['title'] . ' (' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . ')',
                        'file_path' => $filePath,
                        'file_name' => $fileName,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                        'uploaded_by' => auth()->user()->id,
                    ]);

                    $uploadedCount++;
                }

                return redirect()->route('projects.show', $project->id)->with('success', "Successfully uploaded {$uploadedCount} file(s)!");
            }

            return redirect()->route('projects.show', $project->id)->with('error', 'Please upload at least one file.');
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to save documentation: ' . $e->getMessage());
        }
    }

    /**
     * Get a project document details (for viewing text content)
     */
    public function getDocument(Project $project, \App\Models\ProjectDocument $document)
    {
        if ($document->project_id !== $project->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'id' => $document->id,
            'title' => $document->title,
            'content' => $document->content,
            'file_path' => $document->file_path ? asset('storage/' . $document->file_path) : null,
            'file_name' => $document->file_name,
            'mime_type' => $document->mime_type,
            'file_size' => $document->file_size,
            'uploader' => $document->uploader?->name ?? 'Unknown',
            'created_at' => $document->created_at,
        ]);
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
     * Get tasks filtered by material_id
     */
    public function getTasksByMaterial(Request $request, Project $project)
    {
        $materialId = $request->query('material_id');

        if (!$materialId) {
            return response()->json([
                'success' => false,
                'message' => 'Material ID is required'
            ], 400);
        }

        try {
            $tasks = \App\Models\ProjectUpdate::where('project_id', $project->id)
                ->where('material_id', $materialId)
                ->with('updatedBy')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($task) {
                    return [
                        'id' => $task->id,
                        'title' => $task->title,
                        'description' => $task->description,
                        'status' => $task->status,
                        'created_at' => $task->created_at,
                        'updated_by_user' => $task->updatedBy ? [
                            'id' => $task->updatedBy->id,
                            'name' => $task->updatedBy->name
                        ] : null
                    ];
                });

            return response()->json([
                'success' => true,
                'tasks' => $tasks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching tasks: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a project update
     */
    public function storeUpdate(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'status' => 'nullable|in:Ongoing,Completed,On Hold,Cancelled,In Progress',
            'material_id' => 'nullable|exists:materials,id',
        ]);

        try {
            \App\Models\ProjectUpdate::create([
                'project_id' => $project->id,
                'updated_by' => auth()->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $validated['status'] ?? 'Ongoing',
                'material_id' => $validated['material_id'] ?? null,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Project update added successfully!'
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', 'Project update added successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add update: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to add update: ' . $e->getMessage());
        }
    }

    /**
     * Update a project update (task status change)
     */
    public function updateUpdate(Request $request, Project $project, \App\Models\ProjectUpdate $update)
    {
        if ($update->project_id !== $project->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Prevent changing status from Completed
        if ($update->status === 'Completed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot change status of a completed task'
            ], 422);
        }

        $validated = $request->validate([
            'status' => 'required|in:Ongoing,Completed,On Hold,Cancelled,In Progress',
        ]);

        try {
            $update->update([
                'status' => $validated['status'],
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Task status updated successfully!'
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', 'Task status updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update task: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to update task: ' . $e->getMessage());
        }
    }

    /**
     * Store a material for the project
     */
    public function storeMaterial(Request $request, Project $project)
    {
        $validated = $request->validate([
            'item_description' => 'required|string|max:500',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:50',
            'unit_rate' => 'nullable|numeric|min:0',
            'material_cost' => 'nullable|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,approved,failed',
        ]);

        try {
            // Auto-generate item_no (get next number for this project)
            $maxItemNo = Material::where('project_id', $project->id)->max('item_no') ?? 0;
            $nextItemNo = $maxItemNo + 1;

            // Auto-calculate labor cost: Half of material cost
            $materialCost = $validated['material_cost'] ?? 0;
            $laborCost = $materialCost / 2;

            $material = Material::create([
                'project_id' => $project->id,
                'item_no' => $nextItemNo,
                'item_description' => $validated['item_description'],
                'quantity' => $validated['quantity'],
                'unit' => $validated['unit'],
                'unit_rate' => $validated['unit_rate'] ?? 0,
                'material_cost' => $validated['material_cost'] ?? 0,
                'labor_cost' => $laborCost,
                'category' => $validated['category'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'] ?? 'pending',
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material added successfully!',
                    'data' => $material
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', 'Material added successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add material: ' . $e->getMessage()
                ], 422);
            }

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
            'item_description' => 'required|string|max:500',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|string|max:50',
            'unit_rate' => 'nullable|numeric|min:0',
            'material_cost' => 'nullable|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,approved,failed',
        ]);

        try {
            // Check if current status is locked (approved or failed)
            $currentStatus = strtolower($material->status ?? 'pending');
            if (($currentStatus === 'approved' || $currentStatus === 'failed') && isset($validated['status'])) {
                $newStatus = strtolower($validated['status']);
                if ($newStatus !== $currentStatus) {
                    if ($request->expectsJson() || $request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This transaction status is locked and cannot be changed.'
                        ], 403);
                    }
                    return redirect()->route('projects.show', $project->id)
                        ->with('error', 'This transaction status is locked and cannot be changed.');
                }
            }

            // Auto-calculate labor cost: Half of material cost
            $materialCost = $validated['material_cost'] ?? 0;
            $laborCost = $materialCost / 2;

            $material->update([
                'item_description' => $validated['item_description'],
                'quantity' => $validated['quantity'],
                'unit' => $validated['unit'],
                'unit_rate' => $validated['unit_rate'] ?? 0,
                'material_cost' => $validated['material_cost'] ?? 0,
                'labor_cost' => $laborCost,
                'category' => $validated['category'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'] ?? 'pending',
            ]);

            // Return JSON for AJAX requests, redirect for form submissions
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Material updated successfully!',
                    'data' => $material
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', 'Material updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update material: ' . $e->getMessage()
                ], 422);
            }

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
     * Bulk delete materials
     */
    public function bulkDeleteMaterials(Project $project, Request $request)
    {
        $request->validate([
            'material_ids' => 'required|array',
            'material_ids.*' => 'required|integer|exists:materials,id'
        ]);

        try {
            $materialIds = $request->input('material_ids');
            
            // Verify all materials belong to this project
            $materials = Material::whereIn('id', $materialIds)
                ->where('project_id', $project->id)
                ->get();
            
            if ($materials->count() !== count($materialIds)) {
                return redirect()->route('projects.show', $project->id)
                    ->with('error', 'Some materials do not belong to this project.');
            }
            
            // Delete all materials
            Material::whereIn('id', $materialIds)
                ->where('project_id', $project->id)
                ->delete();
            
            $count = count($materialIds);
            return redirect()->route('projects.show', $project->id)
                ->with('success', "Successfully deleted {$count} BOQ item(s)!");
                
        } catch (\Exception $e) {
            return redirect()->route('projects.show', $project->id)
                ->with('error', 'Failed to delete materials: ' . $e->getMessage());
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

    /**
     * QA Inspection - Submit inspection for a BOQ item
     * Only QA role can perform this action
     */
    public function submitQAInspection(Request $request, Project $project, Material $material)
    {
        $user = auth()->user();
        
        // Only QA role can submit inspections
        if (!$user || $user->role !== 'QA') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Only Quality Assurance Officers can perform inspections.'], 403);
            }
            abort(403, 'Only Quality Assurance Officers can perform inspections.');
        }

        $validated = $request->validate([
            'qa_status' => 'required|in:passed,failed,requires_recheck',
            'qa_rating' => 'nullable|integer|min:1|max:5',
            'qa_remarks' => 'nullable|string|max:1000',
            'qa_checklist' => 'nullable|array',
        ]);

        try {
            $material->update([
                'qa_status' => $validated['qa_status'],
                'qa_rating' => $validated['qa_rating'] ?? null,
                'qa_remarks' => $validated['qa_remarks'] ?? null,
                'qa_checklist' => $validated['qa_checklist'] ?? null,
                'qa_inspected_by' => $user->id,
                'qa_inspected_at' => now(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'QA inspection submitted successfully!',
                    'data' => $material->fresh()
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', 'QA inspection submitted successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to submit inspection: ' . $e->getMessage()], 422);
            }
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to submit inspection: ' . $e->getMessage());
        }
    }

    /**
     * QA Bulk Inspection - Submit inspections for multiple BOQ items
     * Only QA role can perform this action
     */
    public function bulkQAInspection(Request $request, Project $project)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== 'QA') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Only Quality Assurance Officers can perform inspections.'], 403);
            }
            abort(403, 'Only Quality Assurance Officers can perform inspections.');
        }

        $validated = $request->validate([
            'material_ids' => 'required|array|min:1',
            'material_ids.*' => 'integer|exists:materials,id',
            'qa_status' => 'required|in:passed,failed,requires_recheck',
            'qa_remarks' => 'nullable|string|max:1000',
        ]);

        try {
            $updatedCount = Material::whereIn('id', $validated['material_ids'])
                ->where('project_id', $project->id)
                ->update([
                    'qa_status' => $validated['qa_status'],
                    'qa_remarks' => $validated['qa_remarks'] ?? null,
                    'qa_inspected_by' => $user->id,
                    'qa_inspected_at' => now(),
                ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "QA inspection submitted for {$updatedCount} items!",
                ]);
            }

            return redirect()->route('projects.show', $project->id)->with('success', "QA inspection submitted for {$updatedCount} items!");
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to submit bulk inspection: ' . $e->getMessage()], 422);
            }
            return redirect()->route('projects.show', $project->id)->with('error', 'Failed to submit bulk inspection: ' . $e->getMessage());
        }
    }

    /**
     * Approve or Reject Material Replacement Request
     * Only OWNER, PM, FM roles can perform this action
     */
    public function processReplacementRequest(Request $request, Material $material)
    {
        $user = auth()->user();
        
        if (!$user || !in_array($user->role, ['OWNER', 'PM', 'FM'])) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Only Owner, Project Manager, or Finance Manager can process replacement requests.'], 403);
            }
            abort(403, 'Unauthorized');
        }

        if (!$material->replacement_requested) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'This material has no pending replacement request.'], 422);
            }
            return back()->with('error', 'This material has no pending replacement request.');
        }

        // Prevent re-processing already processed requests
        if ($material->replacement_status === 'approved' || $material->replacement_status === 'rejected') {
            $status = $material->replacement_status === 'approved' ? 'approved' : 'rejected';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => "This replacement request has already been {$status}. No further action is needed."], 422);
            }
            return back()->with('error', "This replacement request has already been {$status}.");
        }

        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
            'replacement_notes' => 'nullable|string|max:1000',
        ]);

        try {
            $updateData = [
                'replacement_status' => $validated['action'] === 'approve' ? 'approved' : 'rejected',
                'replacement_approved_at' => now(),
                'replacement_approved_by' => $user->id,
                'replacement_notes' => $validated['replacement_notes'] ?? null,
            ];

            // If approved, reset qa_status to requires_recheck and clear needs_replacement flag
            if ($validated['action'] === 'approve') {
                $updateData['qa_status'] = 'requires_recheck';
                $updateData['needs_replacement'] = false;  // Clear the replacement flag so it can be re-inspected normally
            }

            $material->update($updateData);

            $action = $validated['action'] === 'approve' ? 'approved' : 'rejected';
            $message = "Replacement request has been {$action} successfully.";
            if ($validated['action'] === 'approve') {
                $message .= " Material status reset to 'Requires Recheck' for reinspection.";
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => $material->fresh()
                ]);
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to process replacement request: ' . $e->getMessage()], 422);
            }
            return back()->with('error', 'Failed to process replacement request: ' . $e->getMessage());
        }
    }

    /**
     * Get all pending replacement requests for a project
     */
    public function getPendingReplacements(Project $project)
    {
        $user = auth()->user();
        
        if (!$user || !in_array($user->role, ['OWNER', 'PM', 'FM'])) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $pendingReplacements = $project->materials()
            ->where('replacement_requested', true)
            ->where('replacement_status', 'pending')
            ->with(['replacementRequester', 'qaInspector'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pendingReplacements
        ]);
    }
}
