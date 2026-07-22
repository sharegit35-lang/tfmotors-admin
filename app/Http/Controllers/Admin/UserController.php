<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function index()
    {
        // ទាញយក User ទាំងអស់ ព្រមទាំងសិទ្ធិរបស់ពួកគេ
        $users = User::with('roles')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // ទាញយកឈ្មោះសិទ្ធិ (Admin, Staff, Driver...) ដើម្បីបង្ហាញក្នុង Dropdown
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'department' => 'nullable|string|max:255', // បន្ថែម Validation សម្រាប់ department
            'role' => 'required' // តម្រូវឲ្យរើសសិទ្ធិមួយ
        ]);

        // បង្កើតគណនីថ្មី (រួមទាំង department)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
        ]);

        // ភ្ជាប់សិទ្ធិទៅឲ្យគណនីថ្មីនោះ (ឧ. Admin, Driver, Employee)
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')
            ->with('success', 'User account created successfully.');
    }

    public function edit($encrypted_id)
    {
        try {
            $id = Crypt::decrypt($encrypted_id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all(); // ទាញយកសិទ្ធិចាស់របស់គាត់

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $encrypted_id)
    {
        try {
            $id = Crypt::decrypt($encrypted_id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'department' => 'nullable|string|max:255', // បន្ថែម Validation សម្រាប់ department
            'role' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->department = $request->department; // Update department
        
        // ប្រសិនបើមានការវាយបញ្ជូលលេខសម្ងាត់ថ្មី ទើបធ្វើការ Update
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // ផ្លាស់ប្តូរសិទ្ធិចាស់ ដាក់សិទ្ធិថ្មីជំនួសវិញ
        $user->syncRoles($request->role);

        return redirect()->route('admin.users.index')
            ->with('success', 'User information updated.');
    }

    public function destroy($encrypted_id)
    {
        try {
            $id = Crypt::decrypt($encrypted_id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($id);
        
        // ការពារមិនឲ្យ Admin លុបគណនីខ្លួនឯង
        if (auth()->user()->id == $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User account deleted successfully.');
    }
}
