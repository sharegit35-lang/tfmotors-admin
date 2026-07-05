<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // បង្ហាញទំព័រ Login 
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // ពិនិត្យទិន្នន័យពេលចុច Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // ព្យាយាម Login បញ្ចូលក្នុងប្រព័ន្ធ
        if (auth()->attempt($credentials)) {
            
            // ប្រើប្រព័ន្ធ Spatie ដើម្បីឆែកមើលថាតើគាត់មានតួនាទីជា Admin ឬ Staff ដែរឬទេ
            if (auth()->user()->hasAnyRole(['Admin', 'Staff'])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard'); // លោតទៅ Dashboard
            }
            
            // បើគ្មានសិទ្ធិជា Admin ឬ Staff ទេ គឺបណ្តេញចេញវិញ
            auth()->logout();
            return back()->with('error', 'គណនីនេះមិនមានសិទ្ធិចូលប្រើប្រព័ន្ធឡើយ។');
        }

        // បើវាយ Email ឬ Password ខុស
        return back()->with('error', 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។');
    }

    // សម្រាប់ Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }
}