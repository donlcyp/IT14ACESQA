<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('f_name', 'like', '%' . $search . '%')
                    ->orWhere('l_name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('position')) {
            $query->where('position', $request->input('position'));
        }

        $employees = $query
            ->orderBy('f_name')
            ->orderBy('l_name')
            ->paginate(10)
            ->withQueryString();

        $positions = Employee::query()
            ->whereNotNull('position')
            ->where('position', '<>', '')
            ->distinct()
            ->orderBy('position')
            ->pluck('position');

        return view('employee', [
            'employees' => $employees,
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'position'        => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'in:Elementary,High School,Senior High,Vocational/TESDA,Tertiary/College,Graduate Studies'],
            'document'        => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'email'           => ['nullable', 'email', 'max:255'],
            'phone'           => ['nullable', 'string', 'max:50'],
        ]);

        // Create or find user first
        $fullName = $data['first_name'] . ' ' . $data['last_name'];
        $user = \App\Models\User::firstOrCreate(
            ['email' => $data['email'] ?? ('emp.' . time() . '@system.local')],
            [
                'name' => $fullName,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'USER',
                'user_position' => $data['position'],
                'status' => 'Active',
            ]
        );

        // Create employee linked to user (update if exists)
        $employeeData = [
            'user_id' => $user->id,
            'f_name' => $data['first_name'],
            'l_name' => $data['last_name'],
            'position' => $data['position'] ?? null,
        ];

        // Handle optional document upload (store separately if needed)
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('employee_docs', 'public');
            // Store document path in a separate way if needed (not in employee_list table)
        }

        Employee::updateOrCreate(
            ['user_id' => $user->id],
            $employeeData
        );

        return redirect()->route('employee')->with('success', 'Employee added successfully.');
    }

    protected function generateEmployeeCode(): string
    {
        $latest = Employee::latest('id')->value('employee_code');

        if (!$latest) {
            return 'EMP001';
        }

        $numeric = (int) preg_replace('/[^0-9]/', '', $latest);

        return 'EMP' . str_pad($numeric + 1, 3, '0', STR_PAD_LEFT);
    }
}
