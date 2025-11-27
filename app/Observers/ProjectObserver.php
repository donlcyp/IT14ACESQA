<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        // If project is being archived, archive all its materials
        if ($project->isDirty('archived') && $project->archived === true) {
            $project->materials()->update(['archived' => true]);
        }

        // If project is being unarchived, unarchive all its materials
        if ($project->isDirty('archived') && $project->archived === false) {
            $project->materials()->update(['archived' => false]);
        }
    }
}
