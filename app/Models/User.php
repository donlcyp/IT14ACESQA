<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'user_position',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user can manage project employees.
     * Only OWNER and PM roles can manage project employees.
     */
    public function canManageProjectEmployees(): bool
    {
        return in_array($this->role, ['OWNER', 'PM']);
    }

    /**
     * Check if user is HR/Timekeeper.
     * HR role can validate employee attendance.
     */
    public function isHR(): bool
    {
        return $this->role === 'HR';
    }

    /**
     * Check if user can validate attendance.
     * Only HR/Timekeeper role can validate attendance.
     */
    public function canValidateAttendance(): bool
    {
        return $this->role === 'HR';
    }

    /**
     * Check if user is OWNER.
     */
    public function isOwner(): bool
    {
        return $this->role === 'OWNER';
    }

    /**
     * Check if user is PM.
     */
    public function isPM(): bool
    {
        return $this->role === 'PM';
    }

    /**
     * Check if user is Employee.
     * Any role except OWNER is considered an employee
     */
    public function isEmployee(): bool
    {
        return in_array($this->role, ['PM', 'FM', 'HR', 'QA', 'SS', 'CW']);
    }

    /**
     * Check if user is a Site Supervisor.
     */
    public function isSiteSupervisor(): bool
    {
        return $this->role === 'SS';
    }

    /**
     * Check if user is a Quality Assurance Officer.
     */
    public function isQA(): bool
    {
        return $this->role === 'QA';
    }

    /**
     * Check if user is a Finance Manager.
     */
    public function isFM(): bool
    {
        return $this->role === 'FM';
    }

    /**
     * Check if user is a Construction Worker.
     */
    public function isCW(): bool
    {
        return $this->role === 'CW';
    }

    /**
     * Get the employee profile for this user.
     */
    public function employeeProfile()
    {
        return $this->hasOne(EmployeeList::class, 'user_id', 'id');
    }

    /**
     * Get the projects managed by this user.
     */
    public function managedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'assigned_pm_id', 'id');
    }

    /**
     * Get the logs for this user.
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id', 'id');
    }
}

