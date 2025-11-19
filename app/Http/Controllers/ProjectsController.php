<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\Material;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::where('archived', false)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('projects', compact('projects'));
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

        // Check materials clearance: all materials for the project record must be Approved or Failed
        $record = ProjectRecord::where('project_id', $project->id)->first();
        if ($record) {
            $blockers = Material::where('project_record_id', $record->id)
                ->whereNotIn('status', ['Approved', 'Failed'])
                ->count();
            if ($blockers > 0) {
                return redirect()->back()->with('error', 'Not all materials are cleared (Approved/Failed).');
            }
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

        return redirect()->route('archives')->with('success', 'Project restored successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name'        => ['required', 'string', 'max:255'],
            'client_prefix'       => ['nullable', 'string', 'max:50'],
            'client_first_name'   => ['required', 'string', 'max:255'],
            'client_last_name'    => ['required', 'string', 'max:255'],
            'client_suffix'       => ['nullable', 'string', 'max:50'],
            'lead_prefix'         => ['nullable', 'string', 'max:50'],
            'lead_first_name'     => ['required', 'string', 'max:255'],
            'lead_last_name'      => ['required', 'string', 'max:255'],
            'lead_suffix'         => ['nullable', 'string', 'max:50'],
        ]);

        $clientPrefix = $this->normalizeNamePart($validated['client_prefix'] ?? null);
        $clientSuffix = $this->normalizeNamePart($validated['client_suffix'] ?? null);
        $leadPrefix = $this->normalizeNamePart($validated['lead_prefix'] ?? null);
        $leadSuffix = $this->normalizeNamePart($validated['lead_suffix'] ?? null);

        // Default status: Under Review; details must be completed before moving to Ongoing
        $project = Project::create([
            'project_name'        => $validated['project_name'],
            'client_prefix'       => $clientPrefix,
            'client_first_name'   => $validated['client_first_name'],
            'client_last_name'    => $validated['client_last_name'],
            'client_suffix'       => $clientSuffix,
            'client_name'         => $this->composeFullName($clientPrefix, $validated['client_first_name'], $validated['client_last_name'], $clientSuffix),
            'status'              => 'Under Review',
            'lead_prefix'         => $leadPrefix,
            'lead_first_name'     => $validated['lead_first_name'],
            'lead_last_name'      => $validated['lead_last_name'],
            'lead_suffix'         => $leadSuffix,
            'lead'                => $this->composeFullName($leadPrefix, $validated['lead_first_name'], $validated['lead_last_name'], $leadSuffix),
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

    private function composeFullName(?string $prefix, string $firstName, string $lastName, ?string $suffix): string
    {
        $parts = array_filter([
            $this->normalizeNamePart($prefix),
            trim($firstName),
            trim($lastName),
            $this->normalizeNamePart($suffix),
        ], fn ($value) => $value !== null && $value !== '');

        return trim(implode(' ', $parts));
    }

    private function normalizeNamePart(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }
}

