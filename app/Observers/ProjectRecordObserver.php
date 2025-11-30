<?php

namespace App\Observers;

use App\Models\ProjectRecord;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ProjectRecordObserver
{
    public function created(ProjectRecord $projectRecord): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'CREATE_PROJECT_RECORD',
                'log_date' => now(),
                'details' => json_encode([
                    'record_id' => $projectRecord->id,
                    'project_id' => $projectRecord->project_id,
                    'title' => $projectRecord->title,
                    'client' => $projectRecord->client,
                ]),
            ]);
        }
    }

    public function updated(ProjectRecord $projectRecord): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'UPDATE_PROJECT_RECORD',
                'log_date' => now(),
                'details' => json_encode([
                    'record_id' => $projectRecord->id,
                    'changes' => $projectRecord->getChanges(),
                ]),
            ]);
        }
    }

    public function deleted(ProjectRecord $projectRecord): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'DELETE_PROJECT_RECORD',
                'log_date' => now(),
                'details' => json_encode([
                    'record_id' => $projectRecord->id,
                ]),
            ]);
        }
    }
}
