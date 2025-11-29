<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'CREATE_PROJECT',
                'log_date' => now(),
                'details' => json_encode([
                    'project_id' => $project->id,
                    'project_name' => $project->project_name,
                    'project_code' => $project->project_code,
                    'allocated_amount' => $project->allocated_amount,
                ]),
            ]);
        }
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $userId = Auth::id();
        // Check if project is being archived
        if ($project->isDirty('archived')) {
            if ($project->archived === true) {
                if ($userId) {
                    Log::create([
                        'user_id' => $userId,
                        'action' => 'ARCHIVE_PROJECT',
                        'log_date' => now(),
                        'details' => json_encode([
                            'project_id' => $project->id,
                            'project_name' => $project->project_name,
                            'archive_reason' => $project->archive_reason,
                        ]),
                    ]);
                }
            } else {
                if ($userId) {
                    Log::create([
                        'user_id' => $userId,
                        'action' => 'UNARCHIVE_PROJECT',
                        'log_date' => now(),
                        'details' => json_encode([
                            'project_id' => $project->id,
                            'project_name' => $project->project_name,
                        ]),
                    ]);
                }
            }
        } else {
            // Regular update
            if ($userId) {
                Log::create([
                    'user_id' => $userId,
                    'action' => 'UPDATE_PROJECT',
                    'log_date' => now(),
                    'details' => json_encode([
                        'project_id' => $project->id,
                        'project_name' => $project->project_name,
                        'changes' => $project->getChanges(),
                    ]),
                ]);
            }
        }

        // If project is being archived, archive all its materials
        if ($project->isDirty('archived') && $project->archived === true) {
            $project->materials()->update(['archived' => true]);
        }

        // If project is being unarchived, unarchive all its materials
        if ($project->isDirty('archived') && $project->archived === false) {
            $project->materials()->update(['archived' => false]);
        }
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'DELETE_PROJECT',
                'log_date' => now(),
                'details' => json_encode([
                    'project_id' => $project->id,
                    'project_name' => $project->project_name,
                ]),
            ]);
        }
    }
}
