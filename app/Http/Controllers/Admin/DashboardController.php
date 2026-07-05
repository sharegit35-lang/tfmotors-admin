<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $employees = \App\Models\Employee::all();
        return view('admin.dashboard', [
            'totalStaff' => $employees->count(),
            'activeStaff' => $employees->whereIn('status', ['active', 'probation'])->filter(fn($e) => $e->start_work <= now())->count(),
            'pendingJoin' => $employees->whereIn('status', ['active', 'probation'])->filter(fn($e) => $e->start_work > now())->count(),
            'branchCount' => $employees->unique('branch_name')->count()
        ]);
    }
}
