<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectUpdate extends Model
{
    protected $table = 'project_updates';

    protected $fillable = [
        'project_id',
        'updated_by',
        'material_id',
        'title',
        'description',
        'status',
        'type',
        'completion_percentage',
        'workers_present',
        'weather_condition',
        'photos',
        'notes',
        'priority',
        'issue_type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'photos' => 'array',
        'completion_percentage' => 'integer',
        'workers_present' => 'integer',
    ];

    /**
     * Get the project that this update belongs to
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user who created this update
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get the material this update is linked to
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
}
