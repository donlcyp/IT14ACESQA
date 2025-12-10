<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeList::query()->with('user');

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

        $positions = EmployeeList::query()
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
        \Log::info('Employee store request received', $request->all());
        
        $data = $request->validate([
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'position'        => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'in:Elementary,High School,Senior High,Vocational/TESDA,Tertiary/College,Graduate Studies'],
            'document'        => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'email'           => ['nullable', 'email', 'max:255'],
            'phone'           => ['nullable', 'string', 'max:50'],
        ]);

        \Log::info('Employee data validated', $data);

        // Format phone number if provided
        if (!empty($data['phone'])) {
            $data['phone'] = $this->formatPhoneNumber($data['phone']);
        }

        // Create or find user first
        $fullName = $data['first_name'] . ' ' . $data['last_name'];
        $user = \App\Models\User::firstOrCreate(
            ['email' => $data['email'] ?? ('emp.' . time() . '@system.local')],
            [
                'name' => $fullName,
                'phone' => $data['phone'] ?? null,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'USER',
                'user_position' => $data['position'],
                'status' => 'Active',
            ]
        );

        \Log::info('User created/found', ['user_id' => $user->id, 'email' => $user->email]);

        // Update phone if it was provided and the user already exists
        if ($data['phone'] && $user->wasRecentlyCreated === false) {
            $user->update(['phone' => $data['phone']]);
        }

        // Create employee linked to user (update if exists)
        $employeeData = [
            'user_id' => $user->id,
            'f_name' => $data['first_name'],
            'l_name' => $data['last_name'],
            'position' => !empty($data['position']) ? $data['position'] : null,
        ];

        // Handle optional document upload (store separately if needed)
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('employee_docs', 'public');
            \Log::info('Document uploaded', ['path' => $path]);
        }

        $employee = EmployeeList::updateOrCreate(
            ['user_id' => $user->id],
            $employeeData
        );

        \Log::info('Employee created/updated', ['employee_id' => $employee->id]);

        // Redirect to employee page with a search/sort that will show the newly added employee
        return redirect()
            ->route('employee')
            ->with('success', 'Employee added successfully.')
            ->with('showNewEmployee', $data['first_name'] . ' ' . $data['last_name']);
    }

    protected function generateEmployeeCode(): string
    {
        $latest = EmployeeList::latest('id')->value('employee_code');

        if (!$latest) {
            return 'EMP001';
        }

        $numeric = (int) preg_replace('/[^0-9]/', '', $latest);

        return 'EMP' . str_pad($numeric + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Format phone number to +63-000-000-0000 format
     */
    protected function formatPhoneNumber(string $phone): string
    {
        // Remove all non-numeric characters except +
        $phone = preg_replace('/[^\d+]/', '', $phone);

        // Remove leading + if present
        $phone = ltrim($phone, '+');

        // If starts with 0, replace with 63
        if (strpos($phone, '0') === 0) {
            $phone = '63' . substr($phone, 1);
        }

        // Ensure we have the right length (should be 12 digits for +63)
        $phone = preg_replace('/[^\d]/', '', $phone);

        // If it's 10 digits (like 9234567890), prepend 63
        if (strlen($phone) === 10) {
            $phone = '63' . $phone;
        }

        // Format as +63-XXX-XXX-XXXX
        if (strlen($phone) === 12) {
            $phone = '+' . substr($phone, 0, 2) . '-' . substr($phone, 2, 3) . '-' . substr($phone, 5, 3) . '-' . substr($phone, 8, 4);
        }

        return $phone;
    }
}
