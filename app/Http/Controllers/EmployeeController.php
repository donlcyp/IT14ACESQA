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
                    ->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('employee_code', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('position')) {
            $query->where('position', $request->input('position'));
        }

        $employees = $query
            ->orderBy('employee_code')
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
            'email'           => ['nullable', 'email', 'max:255', 'unique:employees,email'],
            'phone'           => ['nullable', 'string', 'max:50'],
        ]);

        $data['employee_code'] = $this->generateEmployeeCode();

        // Handle optional fields normalization
        foreach (['position', 'email', 'phone', 'education_level'] as $key) {
            if (empty($data[$key])) {
                $data[$key] = null;
            }
        }

        // Handle optional document upload
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('employee_docs', 'public');
            $data['document_path'] = $path;
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
