<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. ធ្វើការ Validate ទិន្នន័យដែលផ្ញើមកពី Flutter App
        $request->validate([
            'email' => 'required|string', // អាចជា Email ឬ Name អាស្រ័យលើយើងផ្ញើមក
            'password' => 'required|string',
        ]);

        // 2. ស្វែងរក User តាម Email ឬ Name ដែល Admin បានបង្កើតទុកក្នុង Database
        $user = User::where('email', $request->email)
                    ->orWhere('name', $request->email)
                    ->first();

        // 3. ផ្ទៀងផ្ទាត់ថាតើមាន User នេះពិតប្រាកដ និង Password ត្រឹមត្រូវដែរឬទេ?
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'អ៊ីម៉ែល ឬ លេខសម្ងាត់មិនត្រឹមត្រូវទេ!'
            ], 401); // 401 Unauthorized
        }

        // 4. ប្រសិនបើត្រឹមត្រូវ បង្កើត Token សម្រាប់ទូរស័ព្ទ (Sanctum Token)
        $token = $user->createToken('mobile_app_token')->plainTextToken;

        return response()->json([
            'message' => 'Login ជោគជ័យ',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'department' => $user->department ?? 'General', // បង្ការក្រែងលោគ្មាន field នេះ
            ]
        ], 200);
    }
}