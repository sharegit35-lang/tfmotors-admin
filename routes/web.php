<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\AuthController;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    // ពេលវាយ URL ដើម (tfcam.ct.ws) វានឹងលោតទៅផ្ទាំង Login ភ្លាមៗ
    return redirect()->route('admin.login');
});

// សម្រាប់ឲ្យបេក្ខជនខាងក្រៅចូលមើលការងារ និងដាក់ពាក្យ
Route::get('/careers', [EmployeeController::class, 'careers'])->name('careers.index');
Route::post('/careers/apply', [EmployeeController::class, 'apply'])->name('careers.apply');


// ==========================================
// ADMIN AUTHENTICATION ROUTES (សម្រាប់ Login)
// ==========================================
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


// ==========================================
// ADMIN BACKEND ROUTES (ទាមទារ Login: ចូលបានទាំង Admin និង Staff)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // ទំព័រ Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // ទំព័រគ្រប់គ្រងបុគ្គលិក (យើងប្រើ Spatie ដើម្បីលាក់ប៊ូតុង Edit/Delete តាមសិទ្ធិនៅក្នុង Blade ផ្ទាល់)
    Route::resource('employees', EmployeeController::class);

    Route::resource('assets', \App\Http\Controllers\Admin\AssetController::class);
    
});

// ==========================================
// SYSTEM SECURITY ROUTES (ផ្តាច់មុខសម្រាប់តែ "Admin" ប៉ុណ្ណោះ)
// ==========================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ទំព័រគ្រប់គ្រងគណនី (បើ Staff ព្យាយាមចូល វានឹងលោត Error 403 ភ្លាម)
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    
});