<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'client_name',
        'client_prefix',
        'client_first_name',
        'client_last_name',
        'client_suffix',
        'status',
        'lead',
        'lead_prefix',
        'lead_first_name',
        'lead_last_name',
        'lead_suffix',
    ];

    protected $appends = [
        'client_full_name',
        'lead_full_name',
    ];

    public function getClientFullNameAttribute(): string
    {
        return trim(collect([$this->client_prefix, $this->client_first_name, $this->client_last_name, $this->client_suffix])
            ->filter(fn ($segment) => $segment !== null && $segment !== '')
            ->implode(' '));
    }

    public function getLeadFullNameAttribute(): string
    {
        return trim(collect([$this->lead_prefix, $this->lead_first_name, $this->lead_last_name, $this->lead_suffix])
            ->filter(fn ($segment) => $segment !== null && $segment !== '')
            ->implode(' '));
    }
}
