@extends('layouts.admin')
@section('title', 'Edit User Access | TF Admin')
@section('header_title', 'កែប្រែព័ត៌មានគណនី')

@push('styles')
    <style>
        :root {
            --brand-blue: #2563eb;
            --brand-blue-glow: rgba(37, 99, 235, 0.15);
            --surface-bg: #f8fafc;
            --border-color: #e2e8f0;
        }

        /* 1. Entrance Animations */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        
        /* បង្កើតចលនាលោតចេញមកម្តងមួយៗ (Staggered) */
        .animate-item-1 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards; }
        .animate-item-2 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards; }
        .animate-item-3 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards; }

        /* 2. Input Micro-interactions */
        .form-group {
            transition: transform 0.3s ease;
        }
        .form-group:focus-within {
            transform: translateY(-3px);
        }
        
        .form-input {
            width: 100%; 
            background: var(--surface-bg); 
            border: 1px solid var(--border-color); 
            border-radius: 0.85rem;
            padding: 0.85rem 1.2rem; 
            color: #334155; 
            transition: all 0.3s ease; 
            outline: none; 
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
        }
        .form-input:focus { 
            background: #ffffff;
            border-color: var(--brand-blue); 
            box-shadow: 0 0 0 4px var(--brand-blue-glow); 
        }
        
        .form-label { 
            display: block; 
            font-size: 0.75rem; 
            font-weight: 700; 
            color: #64748b; 
            text-transform: uppercase; 
            letter-spacing: 0.08em; 
            margin-bottom: 0.6rem; 
        }

        /* 3. Button Hover Effect */
        .btn-save {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-save::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }
        .btn-save:hover::after {
            left: 100%;
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }
    </style>
@endpush

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex flex-col justify-center items-center py-8">
    
    <div class="max-w-4xl w-full">
        <div class="mb-8 flex items-end justify-between animate-card">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit User Profile</h1>
                <p class="text-slate-500 mt-2 font-medium">Update access level and account details for this user.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-all shadow-sm">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Roster
            </a>
        </div>

        <form action="{{ route('admin.users.update', encrypt($user->id)) }}" method="POST" class="bg-white p-8 md:p-10 rounded-[2rem] border border-slate-100 shadow-2xl shadow-slate-200/50 relative overflow-hidden animate-card">
            @csrf
            @method('PUT')

            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-500 to-indigo-500"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="form-group animate-item-1">
                    <label class="form-label">Full Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                    @error('name') <p class="text-xs text-rose-500 mt-2 font-medium">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group animate-item-1">
                    <label class="form-label">Email Address <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    @error('email') <p class="text-xs text-rose-500 mt-2 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div class="form-group animate-item-2">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current password">
                    <p class="text-[11px] text-slate-400 mt-2 font-medium flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        ទុកចំហ ប្រសិនបើមិនចង់ប្តូរលេខសម្ងាត់ថ្មី
                    </p>
                    @error('password') <p class="text-xs text-rose-500 mt-2 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="form-group animate-item-2">
                    <label class="form-label">Access Role <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="role" class="form-input appearance-none pr-10 cursor-pointer" required>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    @error('role') <p class="text-xs text-rose-500 mt-2 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 flex items-center justify-between animate-item-3">
                <div class="text-sm text-slate-400 font-medium hidden md:block">
                    Last updated: {{ $user->updated_at->format('d M Y, H:i') }}
                </div>
                <button type="submit" class="btn-save w-full md:w-auto px-10 py-3.5 bg-blue-600 text-white font-extrabold rounded-xl shadow-md flex items-center justify-center gap-2 tracking-wide">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    SAVE CHANGES
                </button>
            </div>
        </form>
        
    </div>
</div>
@endsection