<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get the projects for this client.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id', 'client_id');
    }

    /**
     * Get the project managers for this client.
     */
    public function projMatManagers(): HasMany
    {
        return $this->hasMany(ProjMatManage::class, 'client_id', 'client_id');
    }
}
