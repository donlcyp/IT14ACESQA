<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'CREATE_USER',
                'log_date' => now(),
                'details' => json_encode([
                    'new_user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ]),
            ]);
        }
    }

    public function updated(User $user): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'UPDATE_USER',
                'log_date' => now(),
                'details' => json_encode([
                    'updated_user_id' => $user->id,
                    'name' => $user->name,
                    'changes' => $user->getChanges(),
                ]),
            ]);
        }
    }

    public function deleted(User $user): void
    {
        $userId = Auth::id();
        if ($userId) {
            Log::create([
                'user_id' => $userId,
                'action' => 'DELETE_USER',
                'log_date' => now(),
                'details' => json_encode([
                    'deleted_user_id' => $user->id,
                    'name' => $user->name,
                ]),
            ]);
        }
    }
}
