@extends('layouts.admin')
@section('title', 'Job Postings | TF Admin')
@section('header_title', 'បញ្ជីការងារ (Job Postings)')

@push('styles')
<style>
    :root {
        --brand-blue: #2563eb;
        --brand-indigo: #4f46e5;
    }

    /* ---------- Entrance Animations ---------- */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-item-1 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.1s forwards; }
    .animate-item-2 { opacity: 0; animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards; }

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

    .btn-new {
        position: relative;
        z-index: 1;
        overflow: hidden;
        white-space: nowrap;
        transition: all 0.3s ease;
    }
    .btn-new::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.5s ease;
    }
    .btn-new:hover::after { left: 100%; }
    .btn-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
    }

    /* ---------- Table card ---------- */
    .table-card {
        width: 100%;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: clamp(1rem, 0.5rem + 1vw, 1.5rem);
        box-shadow: 0 25px 50px -12px rgba(100, 116, 139, 0.14);
        overflow: hidden;
    }
    .table-scroll { width: 100%; overflow-x: auto; }

    table.data-table { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 860px; 
        table-layout: fixed; 
    }
    .data-table th, .data-table td { vertical-align: middle; }
    
    .data-table thead th {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.9rem 1.5rem;
        white-space: nowrap;
        height: 56px;
        text-align: left; /* ⚡️ បង្ខំឱ្យ Header នៅខាងឆ្វេងជានិច្ច */
    }
    .data-table thead th.text-right {
        text-align: right; /* ⚡️ សម្រាប់ Action Column */
    }

    .data-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s ease;
        height: 64px;
    }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f8fafc; }
    
    .data-table tbody td {
        padding: 0.9rem 1.5rem;
        font-size: 0.9rem;
        color: #334155;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: left; /* ⚡️ បង្ខំឱ្យ Data នៅខាងឆ្វេងជានិច្ច */
    }
    .data-table tbody td.text-right {
        text-align: right;
    }

    .row-title { font-weight: 700; color: #1e293b; }
    .row-meta { color: #64748b; }

    /* Type / Location shown as small neutral chips */
    .data-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.65rem;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569;
    }
    .data-chip svg { width: 0.85rem; height: 0.85rem; color: #94a3b8; flex-shrink: 0; }

    /* ---------- Toggle switch ---------- */
    .switch-form { display: inline-flex; align-items: center; }
    .switch-btn {
        all: unset;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
    }
    .switch-track {
        position: relative;
        width: 42px;
        height: 24px;
        border-radius: 999px;
        background: #e2e8f0;
        transition: background 0.25s ease;
        flex-shrink: 0;
    }
    .switch-track::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.25);
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .switch-track.is-on-status { background: #10b981; }
    .switch-track.is-on-status::after { transform: translateX(18px); }
    .switch-track.is-on-urgent { background: #f43f5e; }
    .switch-track.is-on-urgent::after { transform: translateX(18px); }

    .switch-label {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .switch-label.state-on-status { color: #059669; }
    .switch-label.state-off-status { color: #94a3b8; }
    .switch-label.state-on-urgent { color: #e11d48; display: inline-flex; align-items: center; gap: 0.3rem; }
    .switch-label.state-off-urgent { color: #94a3b8; }

    @keyframes urgentPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    .urgent-dot { animation: urgentPulse 1.4s ease-in-out infinite; }

    /* ---------- Row action icons ---------- */
    .icon-btn {
        padding: 0.5rem;
        border-radius: 0.6rem;
        background: #f8fafc;
        color: #94a3b8;
        transition: all 0.2s ease;
        display: inline-flex;
    }
    .icon-btn:hover.icon-edit { color: var(--brand-blue); background: #eff6ff; }
    .icon-btn:hover.icon-delete { color: #e11d48; background: #fff1f2; }

    /* ---------- Empty state ---------- */
    .empty-state { padding: 4rem 1.5rem; text-align: center; color: #94a3b8; }
    .empty-icon-wrap {
        width: 3rem; height: 3rem;
        background: #f1f5f9;
        border-radius: 999px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.9rem;
    }

    /* ---------- Datatable toolbar ---------- */
    .dt-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .dt-entries {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }
    .dt-entries select {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.4rem 2rem 0.4rem 0.75rem;
        font-size: 0.85rem;
        color: #334155;
        background: #ffffff;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }
    .dt-entries select:focus { border-color: var(--brand-blue); }

    .dt-search {
        position: relative;
        width: 100%;
        max-width: 260px;
    }
    .dt-search input {
        width: 100%;
        padding: 0.55rem 0.9rem 0.55rem 2.4rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.6rem;
        font-size: 0.85rem;
        color: #334155;
        background: #f8fafc;
        outline: none;
        transition: all 0.2s ease;
    }
    .dt-search input:focus {
        background: #ffffff;
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }
    .dt-search svg {
        position: absolute;
        left: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem; height: 1rem;
        color: #94a3b8;
        pointer-events: none;
    }

    /* ---------- Sortable header ---------- */
    .th-sort {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .th-sort:hover { color: var(--brand-blue); }
    .th-sort .sort-icon { width: 0.85rem; height: 0.85rem; opacity: 0.5; }
    .th-sort.active .sort-icon { opacity: 1; color: var(--brand-blue); }
    .th-en {
        display: block;
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        color: #cbd5e1;
        margin-top: 0.15rem;
    }

    /* ---------- Datatable footer ---------- */
    .dt-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.1rem 1.5rem;
        border-top: 1px solid #f1f5f9;
        font-size: 0.82rem;
        color: #64748b;
    }

    @media (max-width: 480px) {
        .hero-banner { flex-direction: column; align-items: flex-start; }
        .dt-toolbar { flex-direction: column; align-items: stretch; }
        .dt-search { max-width: none; }
    }
</style>
@endpush

@section('content')
<div class="page-shell">

    <div class="hero-banner animate-card">
        <div class="hero-content">
            <span class="hero-badge"><span class="dot"></span> ការជ្រើសរើសបុគ្គលិក</span>
            <h1 class="hero-title">បញ្ជីការងារ (Job Postings)</h1>
            <p class="hero-subtitle">គ្រប់គ្រងការប្រកាសការងារ និងកំណត់ភាពបន្ទាន់នៅទីនេះ។</p>
        </div>
        <a href="{{ route('admin.jobs.create') }}" class="btn-new px-6 py-3 bg-amber-500 text-white text-sm font-extrabold rounded-xl shadow-md flex items-center gap-2 tracking-wide">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            បង្កើតការងារថ្មី
        </a>
    </div>

    <div class="table-card animate-item-1">

        {{-- Toolbar --}}
        <div class="dt-toolbar">
            <form method="GET" action="{{ route('admin.jobs.index') }}" class="dt-entries">
                <span>បង្ហាញ</span>
                <select name="per_page" onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $n)
                        <option value="{{ $n }}" {{ request('per_page', 10) == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                <span>entries per page</span>
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>

            <form method="GET" action="{{ route('admin.jobs.index') }}" class="dt-search">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search jobs..." onchange="this.form.submit()">
                @if(request('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif
            </form>
        </div>

        <div class="table-scroll">
            <table class="data-table">
                {{-- ⚡️ កំណត់ទំហំ Column ផ្ទាល់លើ <th> ជំនួសការប្រើ <colgroup> --}}
                <thead>
                    <tr>
                        <th style="width: 26%;">
                            <a href="{{ route('admin.jobs.index', array_merge(request()->query(), ['sort' => 'title', 'dir' => request('sort') === 'title' && request('dir') === 'asc' ? 'desc' : 'asc'])) }}" class="th-sort {{ request('sort') === 'title' ? 'active' : '' }}">
                                ចំណងជើងការងារ
                                <svg class="sort-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg>
                            </a>
                            <span class="th-en">TITLE</span>
                        </th>
                        <th style="width: 14%;">
                            ប្រភេទ
                            <span class="th-en">TYPE</span>
                        </th>
                        <th style="width: 16%;">
                            ទីតាំង
                            <span class="th-en">LOCATION</span>
                        </th>
                        <th style="width: 15%;">
                            ស្ថានភាព
                            <span class="th-en">STATUS</span>
                        </th>
                        <th style="width: 16%;">
                            ភាពបន្ទាន់
                            <span class="th-en">PRIORITY</span>
                        </th>
                        <th style="width: 13%;" class="text-right">
                            សកម្មភាព
                            <span class="th-en">ACTIONS</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <td class="row-title">{{ $job->title }}</td>
                        <td>
                            <span class="data-chip">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $job->employment_type }}
                            </span>
                        </td>
                        <td>
                            <span class="data-chip">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $job->location }}
                            </span>
                        </td>

                        {{-- Status switch --}}
                        <td>
                            <form action="{{ route('admin.jobs.toggle-status', $job->id) }}" method="POST" class="switch-form">
                                @csrf
                                <button type="submit" class="switch-btn" title="ចុចដើម្បីប្តូរស្ថានភាព">
                                    <span class="switch-track {{ $job->status === 'Open' ? 'is-on-status' : '' }}"></span>
                                    <span class="switch-label {{ $job->status === 'Open' ? 'state-on-status' : 'state-off-status' }}">
                                        {{ $job->status === 'Open' ? 'Open' : 'Closed' }}
                                    </span>
                                </button>
                            </form>
                        </td>

                        {{-- Urgent switch --}}
                        <td>
                            <form action="{{ route('admin.jobs.toggle-urgent', $job->id) }}" method="POST" class="switch-form">
                                @csrf
                                <button type="submit" class="switch-btn" title="ចុចដើម្បីប្តូរភាពបន្ទាន់">
                                    <span class="switch-track {{ $job->is_urgent ? 'is-on-urgent' : '' }}"></span>
                                    <span class="switch-label {{ $job->is_urgent ? 'state-on-urgent' : 'state-off-urgent' }}">
                                        @if($job->is_urgent)
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 urgent-dot"></span> URGENT
                                        @else
                                            NORMAL
                                        @endif
                                    </span>
                                </button>
                            </form>
                        </td>

                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="icon-btn icon-edit" title="កែប្រែ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបការងារនេះមែនទេ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn icon-delete" title="លុបចោល">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon-wrap">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p>មិនទាន់មានការងារត្រូវបានប្រកាសនៅឡើយទេ!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if(method_exists($jobs, 'total') && $jobs->total() > 0)
        <div class="dt-footer">
            <span>Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries</span>
            <div>
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>

</div>
@endsection