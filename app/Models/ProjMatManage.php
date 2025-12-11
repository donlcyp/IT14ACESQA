<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjMatManage extends Model
{
    use HasFactory;

    protected $table = 'proj_mat_manage';

    protected $fillable = [
        'project_id',
        'client_id',
        'employee_id',
        'color',
    ];

    /**
     * Get the project this material management entry belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    /**
     * Get the client this material management entry belongs to.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    /**
     * Get the employee this material management entry belongs to.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(EmployeeList::class, 'employee_id', 'id');
    }
}
