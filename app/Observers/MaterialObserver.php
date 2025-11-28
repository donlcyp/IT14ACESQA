<?php

namespace App\Observers;

use App\Models\Material;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class MaterialObserver
{
    public function created(Material $material): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'CREATE_MATERIAL',
            'log_date' => now(),
            'details' => json_encode([
                'material_id' => $material->id,
                'material_name' => $material->material_name,
                'project_id' => $material->project_id,
                'status' => $material->status,
                'total_cost' => $material->total_cost,
            ]),
        ]);
    }

    public function updated(Material $material): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_MATERIAL',
            'log_date' => now(),
            'details' => json_encode([
                'material_id' => $material->id,
                'material_name' => $material->material_name,
                'status' => $material->status,
                'changes' => $material->getChanges(),
            ]),
        ]);
    }

    public function deleted(Material $material): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'DELETE_MATERIAL',
            'log_date' => now(),
            'details' => json_encode([
                'material_id' => $material->id,
                'material_name' => $material->material_name,
            ]),
        ]);
    }
}
