<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\EmployeeList;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'assignedPM'])->get();
        return view('projects', compact('projects'));
    }

    public function create()
    {
        $clients = Client::all();
        $employees = EmployeeList::all();
        return view('projects.create', compact('clients', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ClientID' => 'required|exists:clients,ClientID',
            'ProjectCode' => 'required|string|max:255|unique:projects,ProjectCode',
            'Description' => 'nullable|string',
            'Location' => 'nullable|string|max:255',
            'Industry' => 'nullable|string|max:255',
            'DateStarted' => 'nullable|date',
            'DateEnded' => 'nullable|date|after_or_equal:DateStarted',
            'TargetTimeline' => 'nullable|string|max:255',
            'AssignedPMID' => 'nullable|exists:employee_list,EmployeeID',
            'AllocatedAmount' => 'nullable|numeric|min:0',
            'UsedAmount' => 'nullable|numeric|min:0',
            'Status' => 'required|string|max:255',
            'NoteRemarks' => 'nullable|string',
            'PMMStatus' => 'nullable|string|max:255',
        ]);

        Project::create($validated);
        return redirect()->route('projects')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['client', 'assignedPM', 'purchaseOrders', 'projMatManages']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = Client::all();
        $employees = EmployeeList::all();
        return view('projects.edit', compact('project', 'clients', 'employees'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'ClientID' => 'required|exists:clients,ClientID',
            'ProjectCode' => 'required|string|max:255|unique:projects,ProjectCode,' . $project->id,
            'Description' => 'nullable|string',
            'Location' => 'nullable|string|max:255',
            'Industry' => 'nullable|string|max:255',
            'DateStarted' => 'nullable|date',
            'DateEnded' => 'nullable|date|after_or_equal:DateStarted',
            'TargetTimeline' => 'nullable|string|max:255',
            'AssignedPMID' => 'nullable|exists:employee_list,EmployeeID',
            'AllocatedAmount' => 'nullable|numeric|min:0',
            'UsedAmount' => 'nullable|numeric|min:0',
            'Status' => 'required|string|max:255',
            'NoteRemarks' => 'nullable|string',
            'PMMStatus' => 'nullable|string|max:255',
        ]);

        $project->update($validated);
        return redirect()->route('projects')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects')->with('success', 'Project deleted successfully.');
    }
}
