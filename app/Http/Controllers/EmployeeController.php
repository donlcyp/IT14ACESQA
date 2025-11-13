<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderByDesc('created_at')->get();

        return view('employee', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'position'   => ['nullable', 'string', 'max:255'],
            'email'      => ['nullable', 'email', 'max:255', 'unique:employees,email'],
            'phone'      => ['nullable', 'string', 'max:50'],
        ]);

        $data['employee_code'] = $this->generateEmployeeCode();

        foreach (['position', 'email', 'phone'] as $key) {
            if (empty($data[$key])) {
                $data[$key] = null;
            }
        }

        Employee::create($data);

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
