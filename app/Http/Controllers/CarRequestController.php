<?php

namespace App\Http\Controllers;

use App\Models\CarRequest;
use Illuminate\Http\Request;

class CarRequestController extends Controller
{
    // ទាញយកប្រវត្តិសំណើទាំងអស់ (API សម្រាប់ Flutter)
    public function index(Request $request)
    {
        $user = $request->user(); // ទាញយក User ពី Token ដែលបញ្ជូនមកពី Flutter

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // 1. បើជា Admin, Super Admin ឬ Driver (តាកុងឡាន) អនុញ្ញាតឱ្យទាញយកសំណើទាំងអស់
        if ($user->hasRole(['Super Admin', 'Admin', 'Driver']) || (isset($user->is_admin) && $user->is_admin == 1)) {
            $requests = CarRequest::orderBy('created_at', 'desc')->get();
        } 
        // 2. បើជាបុគ្គលិកធម្មតា ទាញយកតែសំណើរបស់គាត់ប៉ុណ្ណោះ
        else {
            $requests = CarRequest::where('name', $user->name)
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        }

        return response()->json($requests, 200);
    }

    // បញ្ជូនសំណើថ្មីទៅ Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'destination' => 'required',
            'purpose' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $carRequest = CarRequest::create($validated);
        
        return response()->json([
            'message' => 'Request created successfully', 
            'data' => $carRequest
        ], 201);
    }

    // ផ្លាស់ប្តូរស្ថានភាពសំណើ (Approve / Reject)
    public function updateStatus(Request $request, $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized — មិនទាន់ Login ឬ Token ខុស'], 401);
        }

        // ឆែកសិទ្ធិ: អនុញ្ញាតឱ្យ Admin, Super Admin ឬ User ដែលមាន is_admin == 1 អាចប្តូរស្ថានភាពបាន
        $isAdminRole = $user->hasRole(['Super Admin', 'Admin', 'admin', 'super-admin']);
        $isColumnAdmin = isset($user->is_admin) && $user->is_admin == 1;

        if (!$isAdminRole && !$isColumnAdmin) {
            return response()->json([
                'message' => 'អ្នកគ្មានសិទ្ធិអនុម័តសំណើនេះទេ',
                'user_name' => $user->name
            ], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected,Pending' // កំណត់ឱ្យទទួលយកតែ៣ពាក្យនេះ
        ]);

        $carRequest = CarRequest::find($id);

        if (!$carRequest) {
            return response()->json(['message' => 'រកសំណើមិនឃើញទេ'], 404);
        }

        $carRequest->status = $validated['status'];
        $carRequest->save();

        return response()->json([
            'message' => 'ស្ថានភាពត្រូវបានផ្លាស់ប្តូរជោគជ័យ',
            'data' => $carRequest
        ], 200);
    }
}