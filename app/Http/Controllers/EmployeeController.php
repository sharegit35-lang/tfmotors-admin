<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = \App\Models\Employee::latest()->get();


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
     */public function edit($id)
    {
        try {
            if (ctype_xdigit($id)) {
                $decrypted_id = Crypt::decryptString(hex2bin($id));
            } else {
                $decrypted_id = Crypt::decryptString($id);
            }
            $employee = Employee::findOrFail($decrypted_id);
            return view('employees.edit', compact('employee'));

        } catch (\Exception $e) {
            // យើងប្តូរពី 404 មកចេញអក្សរនេះវិញ ដើម្បីដឹងថាវាមកដល់ទីនេះឬអត់
            dd("បញ្ហានៅ Controller! កូដ URL គឺ: " . $id . " | Error: " . $e->getMessage());
        }
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            if (ctype_xdigit($id)) {
                $decrypted_id = Crypt::decryptString(hex2bin($id));
            } else {
                $decrypted_id = Crypt::decryptString($id);
            }
            $employee = Employee::findOrFail($decrypted_id);
        } catch (\Exception $e) {
            abort(404, 'Employee not found or link is invalid.');
        }

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

        return redirect()->route('admin.employees.index')
            ->with('success', 'Personnel record for ' . $employee->english_name . ' has been synchronized.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy($id)
    {
        try {
            if (ctype_xdigit($id)) {
                $decrypted_id = Crypt::decryptString(hex2bin($id));
            } else {
                $decrypted_id = Crypt::decryptString($id);
            }
            $employee = Employee::findOrFail($decrypted_id);
        } catch (\Exception $e) {
            abort(404, 'Employee not found or link is invalid.');
        }

        $employee->delete();
        
        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee record permanently removed from registry.');
    }

    // ==========================================
    // PUBLIC CAREER ROUTES
    // ==========================================

    /**
     * សម្រាប់ឲ្យបេក្ខជនខាងក្រៅចូលមើលការងារ និងដាក់ពាក្យ
     */
    public function careers()
    {
        // Your logic to show jobs
        return view('careers.index');
    }

    public function apply(Request $request)
    {
        // Your logic to process job applications
        return back()->with('success', 'Application submitted!');
    }
}