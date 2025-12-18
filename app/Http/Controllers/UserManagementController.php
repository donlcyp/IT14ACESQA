<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with filtering.
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }
        
        $users = $query->orderBy('name')->paginate(10)->withQueryString();
        $roles = $this->roles();
        $allRoles = $this->allRolesForFilter();
        $filters = $request->only(['search', 'role']);
        
        return view('admin.users.index', compact('users', 'roles', 'allRoles', 'filters'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = $this->roles();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $roles = $this->roles();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'role' => ['required', 'in:' . implode(',', $roles)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
    }

    private function roles(): array
    {
        // Allowed roles in the system
        $roles = ['OWNER', 'PM', 'FM', 'HR', 'QA', 'SS', 'CW'];

        // Only allow OWNER if none exists to enforce single owner rule
        if (User::where('role', 'OWNER')->exists()) {
            $roles = array_values(array_filter($roles, fn ($role) => $role !== 'OWNER'));
        }

        return $roles;
    }
    
    /**
     * Get all roles for filtering (including OWNER).
     */
    private function allRolesForFilter(): array
    {
        return [
            'OWNER' => 'Owner',
            'PM' => 'Project Manager',
            'FM' => 'Finance Manager',
            'HR' => 'HR/Timekeeper',
            'QA' => 'Quality Assurance',
            'SS' => 'Site Supervisor',
            'CW' => 'Construction Worker',
        ];
    }
    
    /**
     * Get role display name.
     */
    public static function getRoleDisplayName(string $role): string
    {
        $roleNames = [
            'OWNER' => 'Owner',
            'PM' => 'Project Manager',
            'FM' => 'Finance Manager',
            'HR' => 'HR/Timekeeper',
            'QA' => 'Quality Assurance',
            'SS' => 'Site Supervisor',
            'CW' => 'Construction Worker',
        ];
        
        return $roleNames[$role] ?? $role;
    }
}
