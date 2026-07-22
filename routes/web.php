<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
// ត្រូវប្រាកដថាអ្នក Import គ្រប់ Controllers ទាំងអស់
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\CarRequestController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\FacebookController;

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
// URL សម្ងាត់សម្រាប់ Login
Route::get('/my-secret-access', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/my-secret-access', [AuthController::class, 'login']);


// ==========================================
// ADMIN BACKEND ROUTES (ទាមទារ Login)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // មុខងារ Logout 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // គ្រប់គ្រងសំណើឡាន (Car Requests)
    Route::get('/requests', [CarRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests/{id}/status', [CarRequestController::class, 'updateStatus'])->name('requests.status');

    Route::resource('employees', EmployeeController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('jobs', JobPostController::class);
    
    Route::post('/jobs/{job}/toggle-status', [JobPostController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::post('/jobs/{job}/toggle-urgent', [JobPostController::class, 'toggleUrgent'])->name('jobs.toggle-urgent');
});


// ==========================================
// SYSTEM SECURITY ROUTES (Admin តែប៉ុណ្ណោះ)
// ==========================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});


// ==========================================
// WEDDING ROUTES
// ==========================================
Route::get('/wedding', [WeddingController::class, 'index'])->name('wedding.index');
Route::post('/wedding/rsvp', [WeddingController::class, 'rsvp'])->name('wedding.rsvp');
Route::get('/wedding/admin-dashboard', [WeddingController::class, 'dashboard'])->name('wedding.dashboard');


// ==========================================
// FACEBOOK WEBHOOK ROUTES
// ==========================================
Route::get('/webhook/facebook', [FacebookController::class, 'verifyWebhook']);
Route::post('/webhook/facebook', [FacebookController::class, 'handleWebhook']);