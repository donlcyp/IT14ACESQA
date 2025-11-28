<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ClientObserver
{
    public function created(Client $client): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'CREATE_CLIENT',
            'log_date' => now(),
            'details' => json_encode([
                'client_id' => $client->id,
                'company_name' => $client->company_name,
                'contact_person' => $client->contact_person,
                'email' => $client->email,
            ]),
        ]);
    }

    public function updated(Client $client): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_CLIENT',
            'log_date' => now(),
            'details' => json_encode([
                'client_id' => $client->id,
                'company_name' => $client->company_name,
                'changes' => $client->getChanges(),
            ]),
        ]);
    }

    public function deleted(Client $client): void
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'DELETE_CLIENT',
            'log_date' => now(),
            'details' => json_encode([
                'client_id' => $client->id,
                'company_name' => $client->company_name,
            ]),
        ]);
    }
}
