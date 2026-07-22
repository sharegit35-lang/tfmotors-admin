<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // បង្ហាញទំព័រ Login (សម្រាប់ Web)
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // ពិនិត្យទិន្នន័យពេលចុច Login (ប្រើសម្រាប់ទាំង Web និង Flutter App)
    public function login(Request $request)
    {
        // 1. ទទួលយកទាំង email/name និង password យ៉ាងបត់បែន
        $request->validate([
            'email' => 'required|string', // អាចជា Email ឬ Name
            'password' => 'required|string'
        ]);

        $loginInput = $request->input('email');
        $password = $request->input('password');

        // 2. ស្វែងរក User តាម Email ឬ Name
        $user = User::where('email', $loginInput)
                    ->orWhere('name', $loginInput)
                    ->first();

        // 3. ផ្ទៀងផ្ទាត់ Password ផ្ទាល់ (ធានាថាប្រាកដជារកឃើញនិងត្រូវគ្នា)
        if (!$user || !Hash::check($password, $user->password)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។'], 401);
            }
            return back()->with('error', 'អ៊ីមែល ឬលេខសម្ងាត់មិនត្រឹមត្រូវ។');
        }

        // 4. ធ្វើការ Login ចូល Session (សម្រាប់ Web)
        Auth::login($user, true);

        // 5. ឆែកសិទ្ធិ: អនុញ្ញាតឱ្យ Super Admin, Admin និង Driver ចូលបាន
        if ($user->hasAnyRole(['Super Admin', 'Admin', 'Driver'])) {
            
            // ប្រសិនបើ Flutter App ជាអ្នកហៅ API មក (ស្នើសុំ JSON)
            if ($request->expectsJson() || $request->is('api/*')) {
                $token = $user->createToken('admin_mobile_token')->plainTextToken;
                
                // ទាញយក Role ពិតប្រាកដពី Database
                $userRole = $user->getRoleNames()->first() ?? 'Admin';

                return response()->json([
                    'message' => 'Login ជោគជ័យ',
                    'token' => $token,
                    'role' => $userRole,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'department' => $user->department ?? 'General',
                        'role' => $userRole,
                    ]
                ], 200);
            }

            // ប្រសិនបើ Web Browser ជាអ្នក Login
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        
        // បើគ្មានសិទ្ធិគ្រប់គ្រាន់
        Auth::logout();
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'គណនីនេះមិនមានសិទ្ធិចូលប្រើប្រព័ន្ធឡើយ។'], 403);
        }
        return back()->with('error', 'គណនីនេះមិនមានសិទ្ធិចូលប្រើប្រព័ន្ធឡើយ។');
    }
    
    // សម្រាប់ Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}