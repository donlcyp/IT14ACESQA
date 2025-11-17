<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

        // Force default status to "On Track" on create; not editable in create modal
        $project = Project::create([
            'project_name'        => $validated['project_name'],
            'client_prefix'       => $clientPrefix,
            'client_first_name'   => $validated['client_first_name'],
            'client_last_name'    => $validated['client_last_name'],
            'client_suffix'       => $clientSuffix,
            'client_name'         => $this->composeFullName($clientPrefix, $validated['client_first_name'], $validated['client_last_name'], $clientSuffix),
            'status'              => 'On Track',
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

