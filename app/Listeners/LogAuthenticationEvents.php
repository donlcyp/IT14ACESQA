<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\Log;

class LogAuthenticationEvents
{
    /**
     * Handle user login
     */
    public function handleLogin(Login $event)
    {
        Log::create([
            'user_id' => $event->user->id,
            'action' => 'LOGIN',
            'log_date' => now(),
            'details' => json_encode([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]),
        ]);
    }

    /**
     * Handle user logout
     */
    public function handleLogout(Logout $event)
    {
        if ($event->user) {
            Log::create([
                'user_id' => $event->user->id,
                'action' => 'LOGOUT',
                'log_date' => now(),
                'details' => json_encode([
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]),
            ]);
        }
    }
}
