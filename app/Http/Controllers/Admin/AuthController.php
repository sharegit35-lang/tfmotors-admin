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

        // ថែមពាក្យ true នៅទីនេះ ដើម្បីបង្ខំឲ្យប្រព័ន្ធចងចាំ (Remember Me) ជាប់រហូត
        if (Auth::attempt($credentials, true)) {
            
            if (Auth::user()->hasAnyRole(['Admin', 'Staff'])) {
                $request->session()->regenerate();
                
                // ⚡️ Update: ប្រើ intended() ដើម្បីឱ្យបទពិសោធន៍ប្រើប្រាស់កាន់តែរលូន
                return redirect()->intended(route('admin.dashboard'));
            }
            
            Auth::logout();
            return back()->with('error', 'គណនីនេះមិនមានសិទ្ធិចូលប្រើប្រព័ន្ធឡើយ។');
        }

        return back()->with('error', 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។');
    }
    
    // សម្រាប់ Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // ⚡️ ប្រើប្រាស់ route('admin.login') ដើម្បីឱ្យវាលោតទៅរក URL ថ្មី (/my-secret-access) ដោយស្វ័យប្រវត្តិ
        return redirect()->route('admin.login');
    }
}