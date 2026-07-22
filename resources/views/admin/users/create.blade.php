@extends('layouts.admin')
@section('title', 'New System User | TF Admin')
@section('header_title', 'បង្កើតគណនីថ្មី')

@push('styles')
    <style>
        :root {
            --brand-blue: #2563eb;
            --brand-blue-dark: #1d4ed8;
            --brand-indigo: #4f46e5;
            --brand-blue-glow: rgba(37, 99, 235, 0.15);
            --surface-bg: #f8fafc;
            --border-color: #e2e8f0;
            --text-muted: #64748b;
        }

        /* ---------- Entrance Animations ---------- */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        .animate-item-1 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards; }
        .animate-item-2 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards; }
        .animate-item-3 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards; }

        /* ---------- Full-width page (no centering, no max-width cap) ---------- */
        .page-shell {
            width: 100%;
        }

        /* ---------- Dark banner header, matches System Users listing page ---------- */
        .hero-banner {
            width: 100%;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border-radius: clamp(1rem, 0.5rem + 1vw, 1.75rem);
            padding: clamp(1.5rem, 1rem + 2vw, 2.75rem);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: center;
            justify-content: space-between;
            margin-bottom: clamp(1.5rem, 1rem + 2vw, 2rem);
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #93c5fd;
            background: rgba(147, 197, 253, 0.1);
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            margin-bottom: 0.9rem;
        }

        .hero-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.25);
        }

        .hero-title {
            font-size: clamp(1.6rem, 1.2rem + 1.8vw, 2.4rem);
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .hero-subtitle {
            color: #94a3b8;
            font-weight: 500;
            margin-top: 0.6rem;
            font-size: clamp(0.85rem, 0.8rem + 0.2vw, 0.95rem);
        }

        .hero-content { position: relative; z-index: 1; }

        .back-link {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
        }
        .back-link:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
        }

        /* ---------- Card ---------- */
        .form-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: clamp(1rem, 0.5rem + 1vw, 1.75rem);
            box-shadow: 0 25px 50px -12px rgba(100, 116, 139, 0.16);
            position: relative;
            overflow: hidden;
            padding: clamp(1.25rem, 1rem + 2vw, 2.75rem);
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 5px;
            background: linear-gradient(90deg, var(--brand-blue), var(--brand-indigo));
        }

        .card-section-label {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .card-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f1f5f9;
        }

        /* ---------- Responsive field grid ---------- */
        .field-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 280px), 1fr));
            gap: clamp(1.25rem, 1rem + 1vw, 1.75rem);
        }

        /* ---------- Input with icon ---------- */
        .form-group { transition: transform 0.3s ease; }
        .form-group:focus-within { transform: translateY(-3px); }

        .input-shell {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            width: 1.1rem;
            height: 1.1rem;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .form-group:focus-within .input-icon {
            color: var(--brand-blue);
        }

        .form-input {
            width: 100%;
            background: var(--surface-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.85rem;
            padding: 0.85rem 1.2rem 0.85rem 2.75rem;
            color: #334155;
            transition: all 0.3s ease;
            outline: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            box-sizing: border-box;
        }
        .form-input:focus {
            background: #ffffff;
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 4px var(--brand-blue-glow);
        }

        select.form-input { padding-right: 2.5rem; }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.6rem;
        }

        .helper-text {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .error-text {
            font-size: 12px;
            color: #f43f5e;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        /* ---------- Footer / submit ---------- */
        .form-footer {
            border-top: 1px solid #f1f5f9;
            margin-top: clamp(1.5rem, 1rem + 2vw, 2rem);
            padding-top: clamp(1.25rem, 1rem + 1.5vw, 2rem);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .footer-note {
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* ---------- Button ---------- */
        .btn-submit {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }
        .btn-submit:hover::after { left: 100%; }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }

        @media (min-width: 640px) {
            .btn-submit { width: auto; }
            .form-footer { justify-content: flex-end; }
        }

        @media (max-width: 480px) {
            .hero-banner { flex-direction: column; align-items: flex-start; }
            .form-footer { flex-direction: column-reverse; align-items: stretch; }
            .footer-note { text-align: center; }
        }
    </style>
@endpush

@section('content')
<div class="page-shell">

    <div class="hero-banner animate-card">
        <div class="hero-content">
            <span class="hero-badge"><span class="dot"></span> New Account</span>
            <h1 class="hero-title">Add New User</h1>
            <p class="hero-subtitle">Register a new access account for the system.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="back-link group px-5 py-2.5 rounded-xl text-sm font-bold transition-all">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Roster
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="form-card animate-card">
        @csrf

        <p class="card-section-label">Account Details</p>

        <div class="field-grid mb-6">
            <div class="form-group animate-item-1">
                <label class="form-label">Full Name <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Ex: John Doe" required>
                </div>
                @error('name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group animate-item-1">
                <label class="form-label">Email Address <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="user@tfmotors.com" required>
                </div>
                @error('email') <p class="error-text">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Department Field Added Here -->
        <div class="field-grid mb-6">
            <div class="form-group animate-item-1">
                <label class="form-label">Department / ផ្នែក</label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <input type="text" name="department" class="form-input" value="{{ old('department') }}" placeholder="Ex: Sales, IT, HR, Logistics">
                </div>
                <p class="helper-text">ផ្នែកឬដេប៉ាតឺម៉ង់របស់បុគ្គលិក (សម្រាប់ប្រើប្រាស់ពេលស្នើសុំឡាន)</p>
                @error('department') <p class="error-text">{{ $message }}</p> @enderror
            </div>
        </div>

        <p class="card-section-label">Security &amp; Access</p>

        <div class="field-grid mb-4">
            <div class="form-group animate-item-2">
                <label class="form-label">Password <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v2"/></svg>
                    <input type="password" name="password" class="form-input" placeholder="Create a secure password" required minlength="6">
                </div>
                <p class="helper-text">យ៉ាងតិច ៦ ខ្ទង់ឡើងទៅ</p>
                @error('password') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group animate-item-2">
                <label class="form-label">Access Role <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <select name="role" class="form-input appearance-none cursor-pointer" required>
                        <option value="" disabled selected>-- Select Role Level --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 absolute right-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>
                @error('role') <p class="error-text">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-footer animate-item-3">
            <p class="footer-note">Fields marked <span class="text-rose-500">*</span> are required.</p>
            <button type="submit" class="btn-submit px-10 py-3.5 bg-blue-600 text-white font-extrabold rounded-xl shadow-md flex items-center justify-center gap-2 tracking-wide">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                CREATE ACCOUNT
            </button>
        </div>
    </form>

</div>
@endsection