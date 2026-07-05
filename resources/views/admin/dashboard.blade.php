@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('header_title', 'ទំព័រដើម (Overview)')
@section('content')

<style>
    @keyframes dashFadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .dash-animate { opacity: 0; animation: dashFadeUp .6s ease forwards; }
    .dash-delay-1 { animation-delay: .05s; }
    .dash-delay-2 { animation-delay: .15s; }
    .dash-delay-3 { animation-delay: .25s; }
    .dash-delay-4 { animation-delay: .35s; }
    .dash-delay-5 { animation-delay: .45s; }

    .dash-card { transition: transform .25s ease, box-shadow .25s ease; }
    .dash-card:hover { transform: translateY(-3px); box-shadow: 0 14px 28px -10px rgba(15,43,61,0.14); }

    .dash-km { font-family: 'Noto Sans Khmer', 'Inter', sans-serif; }

    @media (prefers-reduced-motion: reduce) {
        .dash-animate { animation: none; opacity: 1; }
        .dash-card { transition: none; }
    }
</style>

<div class="space-y-8">

    {{-- Greeting hero --}}
    <div class="dash-animate relative overflow-hidden rounded-2xl p-8 md:p-10"
         style="background:linear-gradient(135deg,#0f2b3d,#123447 55%,#0a1f2c);">

        <div class="absolute -right-10 -top-10 w-52 h-52 rounded-full pointer-events-none"
             style="background:radial-gradient(circle,rgba(212,175,55,0.18),transparent 70%);"></div>
        <div class="absolute right-24 -bottom-10 w-40 h-40 rounded-full pointer-events-none"
             style="background:radial-gradient(circle,rgba(212,175,55,0.12),transparent 70%);"></div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center shrink-0"
                     style="background:rgba(212,175,55,0.15); border:1px solid rgba(212,175,55,0.35);">
                    <svg class="w-7 h-7" style="color:#d4af37;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs tracking-[0.2em] uppercase mb-1" style="color:rgba(243,236,217,0.55);">Overview</p>
                    <h3 class="dash-km text-2xl md:text-3xl font-bold text-white">
                        ស្វាគមន៍ត្រឡប់មកវិញ, {{ auth()->user()->name ?? 'Admin' }}
                    </h3>
                </div>
            </div>
            <div class="text-sm text-right" style="color:rgba(243,236,217,0.7);">
                <p>{{ now()->format('l, d F Y') }}</p>
                <p style="color:#d4af37;">{{ now()->format('h:i A') }}</p>
            </div>
        </div>

        <p class="dash-km relative mt-6 max-w-2xl text-base leading-relaxed" style="color:rgba(243,236,217,0.75);">
            នេះគឺជាទំព័រ Admin Dashboard។ សូមជ្រើសរើសមុខងារនៅខាងឆ្វេងដៃដើម្បីគ្រប់គ្រងទិន្នន័យបុគ្គលិករបស់ក្រុមហ៊ុន។
        </p>
    </div>

    {{-- Stat cards — sourced live from the employees table --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="dash-animate dash-delay-1 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 rounded-lg bg-slate-50 text-slate-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalStaff }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">បុគ្គលិកសរុប <span class="text-gray-400">· Total Staff</span></p>
        </div>

        <div class="dash-animate dash-delay-2 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    {{ $totalStaff > 0 ? round(($activeStaff / $totalStaff) * 100) : 0 }}%
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $activeStaff }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">សកម្ម / បានចូលធ្វើការ <span class="text-gray-400">· Active / Joined</span></p>
        </div>

        <div class="dash-animate dash-delay-3 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 rounded-lg bg-amber-50 text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">{{ $pendingJoin }}</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $pendingJoin }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">រង់ចាំចូលធ្វើការ <span class="text-gray-400">· Pending Join</span></p>
        </div>

        <div class="dash-animate dash-delay-4 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 rounded-lg bg-sky-50 text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M9 17h.01M15 9h.01M15 13h.01M15 17h.01"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $branchCount }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">សាខាសកម្ម <span class="text-gray-400">· Active Branches</span></p>
        </div>

    </div>

    {{-- Quick actions --}}
    <div class="dash-animate dash-delay-5 bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <h4 class="text-sm font-semibold text-gray-700 mb-4 tracking-wide uppercase">Quick Actions</h4>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.employees.create') }}" class="dash-km inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-white transition hover:opacity-90"
               style="background:#123447;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                បន្ថែមបុគ្គលិក <span class="opacity-70">· Add Employee</span>
            </a>
            <a href="{{ route('admin.employees.index') }}" class="dash-km inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium border transition hover:bg-gray-50"
               style="border-color:#d4af37; color:#8a6d1f;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m0 0l-3-3m3 3l-3 3M4 7h6m-6 4h6m-6 4h6"></path>
                </svg>
                មើលបញ្ជីបុគ្គលិក <span class="opacity-70">· View Employees</span>
            </a>
        </div>
    </div>

</div>

@endsection