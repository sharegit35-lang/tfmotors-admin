<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarRequestController extends Controller
{
    // ទាញយកទិន្នន័យសំណើឡានទាំងអស់មកបង្ហាញនៅលើ Web (Admin Dashboard)
    public function index()
    {
        $user = Auth::user();

        // ប្រសិនបើគ្មាន User Login ទេ (ការពារកំហុស Error បើ Middleware មិនបានបិទជិត)
        if (!$user) {
            return redirect()->route('login');
        }

        // 1. បើជា Super Admin, Admin ឬ Driver (តាកុងឡាន) ឃើញសំណើទាំងអស់
        if ($user->hasRole(['Super Admin', 'Admin', 'Driver'])) {
            $requests = CarRequest::orderBy('created_at', 'desc')->paginate(10);
        } 
        // 2. បើជាបុគ្គលិកធម្មតា ឃើញតែសំណើរបស់ខ្លួនឯងប៉ុណ្ណោះ
        else {
            $requests = CarRequest::where('name', $user->name)
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(10);
        }
        
        return view('admin.requests.index', compact('requests'));
    }

    // សម្រាប់ Admin ឬអ្នកមានសិទ្ធិ ចុច Approve ឬ Reject ពីលើ Web
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        // ឆែកសិទ្ធិ: មានតែ Super Admin និង Admin ទេទើបអាចប្តូរ Status បាន
        // Driver អាចត្រឹមតែមើល មិនអាច Approve ខ្លួនឯងបានទេ
        if (!$user->hasRole(['Super Admin', 'Admin'])) {
            return back()->with('error', 'អ្នកគ្មានសិទ្ធិក្នុងការផ្លាស់ប្តូរស្ថានភាពសំណើនេះទេ!');
        }

        // ឆែកមើលទិន្នន័យដែលបញ្ជូនមក
        $request->validate([
            'status' => 'required|in:Approved,Rejected,Pending'
        ]);

        // ស្វែងរកសំណើតាម ID (បើរកមិនឃើញនឹងលោត 404 Error)
        $carRequest = CarRequest::findOrFail($id);
        
        // ធ្វើការ Update Status
        $carRequest->status = $request->status;
        $carRequest->save();

        // ត្រលប់ទៅទំព័រដើមវិញ ជាមួយសារជោគជ័យ
        return back()->with('success', 'ស្ថានភាពសំណើត្រូវបានផ្លាស់ប្តូរជោគជ័យ!');
    }
}