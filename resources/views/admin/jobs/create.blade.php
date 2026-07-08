@extends('layouts.admin')

@section('title', 'បង្កើតការងារថ្មី | TF Admin')
@section('header_title', 'បង្កើតការងារថ្មី (Post New Job)')

@push('styles')
    <!-- ⚡️ បញ្ចូល Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
    :root {
        --brand-blue: #2563eb;
        --brand-indigo: #4f46e5;
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

    /* ---------- Full-width page ---------- */
    .page-shell { width: 100%; }

    /* ---------- Dark hero banner ---------- */
    .hero-banner {
        width: 100%;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: clamp(1rem, 0.5rem + 1vw, 1.75rem);
        padding: clamp(1.5rem, 1rem + 2vw, 2.5rem);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
        justify-content: space-between;
        margin-bottom: clamp(1.25rem, 1rem + 1.5vw, 1.75rem);
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
    .hero-content { position: relative; z-index: 1; }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #fcd34d;
        background: rgba(252, 211, 77, 0.1);
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        margin-bottom: 0.9rem;
    }
    .hero-badge .dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #fbbf24;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.25);
    }
    .hero-title {
        font-size: clamp(1.4rem, 1.1rem + 1.4vw, 2rem);
        font-weight: 800;
        color: #ffffff;
    }
    .hero-subtitle {
        color: #94a3b8;
        font-weight: 500;
        margin-top: 0.5rem;
        font-size: clamp(0.85rem, 0.8rem + 0.2vw, 0.95rem);
    }

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
        transition: all 0.2s ease;
    }
    .back-link:hover { background: rgba(255, 255, 255, 0.14); color: #ffffff; }

    /* ---------- Form card ---------- */
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
        background: linear-gradient(90deg, #f59e0b, #d97706);
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

    .field-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr));
        gap: clamp(1.25rem, 1rem + 1vw, 1.75rem);
    }

    /* ---------- Input with icon ---------- */
    .form-group { transition: transform 0.3s ease; }
    .form-group:focus-within { transform: translateY(-3px); }

    .input-shell { position: relative; display: flex; align-items: center; }
    .input-icon {
        position: absolute;
        left: 1rem;
        width: 1.1rem;
        height: 1.1rem;
        color: #94a3b8;
        pointer-events: none;
        transition: color 0.3s ease;
    }
    .form-group:focus-within .input-icon { color: var(--brand-blue); }

    .form-input {
        width: 100%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
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
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    }
    .form-input.field-error {
        border-color: #fda4af;
    }
    .form-input.field-error:focus {
        border-color: #f43f5e;
        box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.12);
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

    .error-text {
        font-size: 12px;
        color: #f43f5e;
        margin-top: 0.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ---------- Info hint box ---------- */
    .hint-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 0.65rem;
        padding: 0.7rem 0.9rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        font-size: 0.78rem;
        color: #1d4ed8;
        line-height: 1.5;
    }
    .hint-box svg { width: 1rem; height: 1rem; flex-shrink: 0; margin-top: 0.1rem; }

    /* ---------- Urgent hiring panel ---------- */
    .urgent-panel {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        border-radius: 1rem;
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .urgent-panel h4 {
        font-size: 0.88rem;
        font-weight: 800;
        color: #be123c;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .urgent-panel p {
        font-size: 0.75rem;
        color: rgba(190, 18, 60, 0.75);
        margin-top: 0.2rem;
    }

    /* ---------- Toggle switch ---------- */
    .switch-wrap { position: relative; display: inline-flex; align-items: center; cursor: pointer; }
    .switch-wrap input { position: absolute; opacity: 0; width: 0; height: 0; }
    .switch-track {
        width: 46px; height: 26px;
        border-radius: 999px;
        background: #e2e8f0;
        position: relative;
        transition: background 0.25s ease;
        flex-shrink: 0;
    }
    .switch-track::after {
        content: '';
        position: absolute;
        top: 3px; left: 3px;
        width: 20px; height: 20px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.25);
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .switch-wrap input:checked + .switch-track { background: #f43f5e; }
    .switch-wrap input:checked + .switch-track::after { transform: translateX(20px); }
    .switch-wrap input:focus-visible + .switch-track { box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.25); }

    /* ---------- Footer buttons ---------- */
    .form-footer {
        border-top: 1px solid #f1f5f9;
        margin-top: clamp(1.5rem, 1rem + 2vw, 2rem);
        padding-top: clamp(1.25rem, 1rem + 1.5vw, 2rem);
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    .btn-cancel {
        padding: 0.85rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 0.88rem;
        color: #475569;
        background: #f1f5f9;
        transition: all 0.2s ease;
        text-align: center;
    }
    .btn-cancel:hover { background: #e2e8f0; }

    .btn-submit {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        padding: 0.85rem 2rem;
        border-radius: 0.75rem;
        font-weight: 800;
        font-size: 0.88rem;
        color: #ffffff;
        background: linear-gradient(90deg, var(--brand-blue), var(--brand-indigo));
        box-shadow: 0 8px 18px -6px rgba(37, 99, 235, 0.4);
    }
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    .btn-submit:hover::after { left: 100%; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 22px -6px rgba(37, 99, 235, 0.45); }

    @media (max-width: 480px) {
        .hero-banner { flex-direction: column; align-items: flex-start; }
        .form-footer { flex-direction: column-reverse; }
        .btn-cancel, .btn-submit { width: 100%; }
    }

    /* ⚡️ ---------- ពណ៌ និងក្បាច់រចនាសម្រាប់ Quill Editor ស៊ីជាមួយ Theme របស់បង ---------- */
    .editor-wrapper {
        border-radius: 0.85rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .editor-wrapper:focus-within {
        background: #ffffff;
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    }
    .editor-wrapper.field-error { border-color: #fda4af; }
    .editor-wrapper.field-error:focus-within {
        border-color: #f43f5e;
        box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.12);
    }
    
    .ql-toolbar.ql-snow {
        border: none;
        border-bottom: 1px solid #e2e8f0;
        background: rgba(255, 255, 255, 0.5);
        padding: 12px 16px;
        font-family: inherit;
    }
    .ql-container.ql-snow {
        border: none;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        color: #334155;
        min-height: 250px;
    }
    .ql-editor { padding: 1.25rem 1.5rem; line-height: 1.7; }
    .ql-editor h1, .ql-editor h2, .ql-editor h3 { font-weight: 700; color: #0f172a; margin-bottom: 0.75rem; }
    .ql-editor p { margin-bottom: 0.75rem; }
    .ql-editor ul, .ql-editor ol { padding-left: 1.5rem; margin-bottom: 0.75rem; }
    .ql-editor.ql-blank::before { font-style: normal; color: #94a3b8; }
</style>
@endpush

@section('content')
<div class="page-shell">

    <div class="hero-banner animate-card">
        <div class="hero-content">
            <span class="hero-badge"><span class="dot"></span> ការជ្រើសរើសបុគ្គលិក</span>
            <h1 class="hero-title">បង្កើតការងារថ្មី (Post New Job)</h1>
            <p class="hero-subtitle">សូមបញ្ចូលព័ត៌មានលម្អិតនៃការងារដែលអ្នកចង់ជ្រើសរើស។</p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="back-link group px-5 py-2.5 rounded-xl text-sm font-bold transition-all">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            ត្រឡប់ក្រោយ
        </a>
    </div>

    <!-- ⚡️ បន្ថែម ID ឱ្យ Form សម្រាប់ភ្ជាប់ជាមួយ Quill Script -->
    <form id="job-form" action="{{ route('admin.jobs.store') }}" method="POST" class="form-card animate-card">
        @csrf

        <p class="card-section-label">Job Details</p>

        <div class="field-grid mb-8">
            <div class="form-group md:col-span-2" style="grid-column: 1 / -1;">
                <label for="title" class="form-label">ចំណងជើងការងារ (Job Title) <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="ឧ. Senior Software Developer"
                           class="form-input @error('title') field-error @enderror" required>
                </div>
                @error('title')
                    <p class="error-text"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="employment_type" class="form-label">ប្រភេទការងារ (Type) <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <select name="employment_type" id="employment_type" class="form-input appearance-none cursor-pointer">
                        <option value="Full Time" {{ old('employment_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part Time" {{ old('employment_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                        <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            <div class="form-group">
                <label for="location" class="form-label">ទីតាំង (Location) <span class="text-rose-500">*</span></label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="location" id="location" value="{{ old('location') ?? 'Phnom Penh' }}" placeholder="ឧ. Phnom Penh" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label for="salary_range" class="form-label">ប្រាក់ខែ (Salary Range)</label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2"/><circle cx="12" cy="12" r="9"/></svg>
                    <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}" placeholder="ឧ. $500 - $800 ឬ Competitive" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">ស្ថានភាព (Status)</label>
                <div class="input-shell">
                    <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12.5l2 2 4-4.5"/></svg>
                    <select name="status" id="status" class="form-input appearance-none cursor-pointer">
                        <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>🟢 Open (កំពុងជ្រើសរើស)</option>
                        <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>🔴 Closed (បិទការជ្រើសរើស)</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>

        <div class="urgent-panel mb-8">
            <div>
                <h4>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
                    កំណត់ជាការងារបន្ទាន់ (Urgent Hiring)
                </h4>
                <p>បើកមុខងារនេះដើម្បីបង្ហាញស៊ុមក្រហម និងទាក់ទាញចំណាប់អារម្មណ៍បេក្ខជន។</p>
            </div>
            <label class="switch-wrap">
                <input type="hidden" name="is_urgent" value="0">
                <input type="checkbox" name="is_urgent" value="1" {{ old('is_urgent') ? 'checked' : '' }}>
                <span class="switch-track"></span>
            </label>
        </div>

        <p class="card-section-label">Description</p>

        <div class="form-group">
            <label for="description" class="form-label">ការពិពណ៌នាការងារ (Description) <span class="text-rose-500">*</span></label>
            <div class="hint-box">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>អ្នកអាច Copy & Paste អត្ថបទពី Word មកទីនេះបាន។ ប្រព័ន្ធនឹងរក្សាទម្រង់អក្សរដិត និងចំណុចដោយស្វ័យប្រវត្តិ។</span>
            </div>
            
            <!-- ⚡️ ប្រអប់ Editor ថ្មី -->
            <div class="editor-wrapper @error('description') field-error @enderror">
                <div id="editor-container">{!! old('description') !!}</div>
            </div>
            
            <!-- ⚡️ Input លាក់កំបាំងសម្រាប់បញ្ជូនទិន្នន័យ -->
            <input type="hidden" name="description" id="hidden_description" value="{{ old('description') }}">
            
            @error('description')
                <p class="error-text"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.jobs.index') }}" class="btn-cancel">
                បោះបង់ (Cancel)
            </a>
            <button type="submit" class="btn-submit flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                រក្សាទុក និងប្រកាសការងារ
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <!-- ⚡️ បញ្ចូល Quill.js Library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // បង្កើត Editor ជាមួយ Tool ដែលត្រូវការចាំបាច់
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'សរសេរការពិពណ៌នា តួនាទី និងលក្ខខណ្ឌតម្រូវការទីនេះ...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean'] // ប៊ូតុងសម្រាប់លុប Format
                    ]
                }
            });

            // មុនពេល Submit Form ត្រូវយកទិន្នន័យពី Editor ទៅដាក់ក្នុង Hidden Input
            var form = document.getElementById('job-form');
            form.onsubmit = function() {
                var hiddenDesc = document.getElementById('hidden_description');
                // ប្រសិនបើទទេ ត្រូវ Clear ចោលកុំឱ្យជាប់ tag <p><br></p>
                if (quill.getText().trim().length === 0) {
                    hiddenDesc.value = '';
                } else {
                    hiddenDesc.value = quill.root.innerHTML; 
                }
            };
        });
    </script>
@endpush