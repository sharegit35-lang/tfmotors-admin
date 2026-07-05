<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view("employees.create");
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'english_name'       => 'required|string|max:255',
            'khmer_name'         => 'required|string|max:255',
            'gender'             => 'required|string',
            'identity_card'      => 'required|string|max:50',
            'cambodian_passport' => 'nullable|string|max:50',
            'phone'              => 'nullable|string|max:20',
            'position'           => 'nullable|string|max:255',
            'department_name'    => 'nullable|string|max:255',
            'branch_name'        => 'nullable|string|max:255',
            'branch_code'        => 'nullable|string|max:255',
            'start_work'         => 'nullable|date',
            'date_of_birth'      => 'nullable|date',
            'salary'             => 'nullable|numeric',
            'hire_date'          => 'nullable|date',
            'status'             => 'required|string',
        ]);

        Employee::create($validated);

        // ប្តូរពី employee.index ទៅ admin.employees.index
        return redirect()->route('admin.employees.index')
            ->with('success', 'New employee successfully registered in the system.');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'english_name'       => 'required|string|max:255',
            'khmer_name'         => 'required|string|max:255',
            'gender'             => 'required|string',
            'identity_card'      => 'required|string|max:50',
            'cambodian_passport' => 'nullable|string|max:50',
            'phone'              => 'required|digits_between:9,15',
            'position'           => 'nullable|string|max:255',
            'department_name'    => 'nullable|string|max:255',
            'branch_name'        => 'nullable|string|max:255',
            'branch_code'        => 'nullable|string|max:255',
            'start_work'         => 'nullable|date',
            'date_of_birth'      => 'nullable|date',
            'salary'             => 'nullable|numeric',
            'hire_date'          => 'nullable|date',
            'status'             => 'required|string',
        ]);

        $employee->update($validated);

        // ប្តូរពី employee.index ទៅ admin.employees.index
        return redirect()->route('admin.employees.index')
            ->with('success', 'Personnel record for ' . $employee->english_name . ' has been synchronized.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        
        // ប្តូរពី employee.index ទៅ admin.employees.index
        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee record permanently removed from registry.');
    }

    // ... មុខងារ careers() និង apply() ទុកដដែលបាន ព្រោះវាជា Public Route
}