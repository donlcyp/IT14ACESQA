<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'client',
        'inspector',
        'time',
        'color',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
