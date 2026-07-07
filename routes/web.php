<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JobPostController;

// ==========================================
// PUBLIC ROUTES (តំបន់សាធារណៈ)
// ==========================================
Route::get('/', function () {
    return redirect()->route('careers.index'); // ប្តូរទៅកាន់ Careers ជំនួសឱ្យ Login
});

// សម្រាប់បេក្ខជនដាក់ពាក្យ
Route::get('/careers', [EmployeeController::class, 'careers'])->name('careers.index');
Route::post('/careers/apply', [EmployeeController::class, 'apply'])->name('careers.apply');


// ==========================================
// HIDDEN ADMIN AUTHENTICATION (លាក់ទ្វារចូល)
// ==========================================
// បងអាចប្តូរពាក្យ 'my-secret-access' ទៅជាអ្វីដែលបងតែម្នាក់ឯងដឹង
Route::get('/my-secret-access', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/my-secret-access', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


// ==========================================
// ADMIN BACKEND ROUTES (ទាមទារ Login)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('jobs', JobPostController::class);
    
});

// ==========================================
// SYSTEM SECURITY ROUTES (Admin តែប៉ុណ្ណោះ)
// ==========================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::resource('users', UserController::class);
    
});