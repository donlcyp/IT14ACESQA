<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('projects', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'client_name'  => ['required', 'string', 'max:255'],
            'lead'         => ['required', 'string', 'max:255'],
        ]);

        // Force default status to "On Track" on create; not editable in create modal
        $project = Project::create([
            'project_name' => $validated['project_name'],
            'client_name' => $validated['client_name'],
            'status' => 'On Track',
            'lead' => $validated['lead'],
        ]);

        return redirect()
            ->route('project-material-management', [
                'project_id' => $project->id,
                'open_modal' => 1,
            ])
            ->with('success', 'Project added successfully! You can now create a project material record.');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $project->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('projects')->with('success', 'Project status updated.');
    }
}

