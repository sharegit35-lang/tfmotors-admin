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
</style>

<div class="space-y-8">

    {{-- Greeting hero --}}
    <div class="dash-animate relative overflow-hidden rounded-2xl p-8 md:p-10"
         style="background:linear-gradient(135deg,#0f2b3d,#123447 55%,#0a1f2c);">

        <div class="absolute -right-10 -top-10 w-52 h-52 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(212,175,55,0.18),transparent 70%);"></div>
        
        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(212,175,55,0.15); border:1px solid rgba(212,175,55,0.35);">
                    <svg class="w-7 h-7" style="color:#d4af37;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs tracking-[0.2em] uppercase mb-1" style="color:rgba(243,236,217,0.55);">Overview</p>
                    <h3 class="dash-km text-2xl md:text-3xl font-bold text-white">ស្វាគមន៍ត្រឡប់មកវិញ, {{ auth()->user()->name ?? 'Admin' }}</h3>
                </div>
            </div>
            <div class="text-sm text-right" style="color:rgba(243,236,217,0.7);">
                <p>{{ now()->format('l, d F Y') }}</p>
                <p style="color:#d4af37;">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    {{-- Stats Grid (Employees + Jobs) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Employee Stats --}}
        <div class="dash-animate dash-delay-1 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-3xl font-bold text-gray-800">{{ $totalStaff }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">បុគ្គលិកសរុប <span class="text-gray-400">· Total Staff</span></p>
        </div>

        {{-- Job Stats --}}
        <div class="dash-animate dash-delay-2 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-3xl font-bold text-gray-800">{{ \App\Models\JobPost::count() }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">ការងារសរុប <span class="text-gray-400">· Total Jobs</span></p>
        </div>

        <div class="dash-animate dash-delay-3 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-3xl font-bold text-emerald-600">{{ \App\Models\JobPost::where('status', 'Open')->count() }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">ការងារបើកជ្រើសរើស <span class="text-gray-400">· Open Jobs</span></p>
        </div>

        <div class="dash-animate dash-delay-4 dash-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-3xl font-bold text-rose-600">{{ \App\Models\JobPost::where('is_urgent', true)->count() }}</p>
            <p class="dash-km text-sm text-gray-500 mt-1">ការងារបន្ទាន់ <span class="text-gray-400">· Urgent Jobs</span></p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="dash-animate dash-delay-5 bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <h4 class="text-sm font-semibold text-gray-700 mb-4 tracking-wide uppercase">Quick Actions</h4>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.employees.create') }}" class="dash-km inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-white transition hover:opacity-90" style="background:#123447;">
                ➕ បន្ថែមបុគ្គលិក
            </a>
            <a href="{{ route('admin.jobs.create') }}" class="dash-km inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-white transition hover:opacity-90" style="background:#d4af37;">
                📢 បង្កើតការងារថ្មី
            </a>
        </div>
    </div>

</div>

@endsection