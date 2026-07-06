@extends('layouts.admin')

@section('title', 'បញ្ជីទ្រព្យសម្បត្តិ | TF Admin')
@section('header_title', 'បញ្ជីលិខិតប្រគល់ទ្រព្យសម្បត្តិ')

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
        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-10px); }
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
            padding: clamp(1.5rem, 1rem + 2vw, 2.75rem);
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
            width: 6px; height: 6px; border-radius: 50%;
            background: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.25);
        }

        .hero-title {
            font-size: clamp(1.4rem, 1.1rem + 1.4vw, 2rem);
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.01em;
        }

        .hero-subtitle {
            color: #94a3b8;
            font-weight: 500;
            margin-top: 0.5rem;
            font-size: clamp(0.85rem, 0.8rem + 0.2vw, 0.95rem);
        }

        .hero-content { position: relative; z-index: 1; }

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
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }

        /* ---------- Alert ---------- */
        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #059669;
            border-radius: 1rem;
            padding: 0.9rem 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: clamp(1.25rem, 1rem + 1.5vw, 1.75rem);
            animation: fadeSlideDown 0.3s ease;
        }

        /* ---------- Table card ---------- */
        .table-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .toolbar-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1e293b;
        }

        .table-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: clamp(1rem, 0.5rem + 1vw, 1.5rem);
            box-shadow: 0 25px 50px -12px rgba(100, 116, 139, 0.08);
            overflow: hidden;
        }

        .table-scroll { width: 100%; overflow-x: auto; }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px; /* បង្កើនទំហំបន្តិចដើម្បីកុំឲ្យចង្អៀតប៊ូតុង */
        }

        .data-table thead th {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 1rem 1.5rem;
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s ease;
        }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #f8fafc; }

        .data-table tbody td {
            padding: 1.1rem 1.5rem;
            font-size: 0.9rem;
            color: #334155;
            white-space: nowrap;
            vertical-align: middle;
        }

        .branch-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.7rem;
            height: 1.7rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--brand-blue);
            font-weight: 800;
            font-size: 0.75rem;
        }

        .row-index {
            color: #94a3b8;
            font-weight: 600;
        }

        .row-name {
            font-weight: 700;
            color: #1e293b;
        }

        /* ---------- Datatable Action Buttons ---------- */
        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            padding: 0.4rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .btn-print { background: #ecfdf5; color: #059669; }
        .btn-print:hover { background: #d1fae5; border-color: #a7f3d0; transform: translateY(-1px); }

        .btn-edit { background: #eff6ff; color: #2563eb; }
        .btn-edit:hover { background: #dbeafe; border-color: #bfdbfe; transform: translateY(-1px); }

        .btn-delete { background: #fef2f2; color: #dc2626; border: none; cursor: pointer; }
        .btn-delete:hover { background: #fee2e2; border-color: #fecaca; transform: translateY(-1px); }

        /* ---------- Empty state ---------- */
        .empty-state {
            padding: 4rem 1.5rem;
            text-align: center;
            color: #94a3b8;
        }
        .empty-state svg {
            width: 3rem; height: 3rem;
            margin: 0 auto 0.9rem;
            opacity: 0.25;
        }
        .empty-state p {
            font-weight: 600;
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            .hero-banner { flex-direction: column; align-items: flex-start; }
            .table-toolbar { flex-direction: column; align-items: stretch; }
        }
    </style>
@endpush

@section('content')
<div class="page-shell">

    <div class="hero-banner animate-card">
        <div class="hero-content">
            <span class="hero-badge"><span class="dot"></span> ការគ្រប់គ្រងទ្រព្យសម្បត្តិ</span>
            <h1 class="hero-title">បញ្ជីលិខិតប្រគល់ទ្រព្យសម្បត្តិ</h1>
            <p class="hero-subtitle">តាមដាន និងគ្រប់គ្រងលិខិតប្រគល់ទទួលទ្រព្យសម្បត្តិទាំងអស់របស់និយោជិត។</p>
        </div>
        <a href="{{ route('admin.assets.create') }}" class="btn-new px-6 py-3 bg-blue-600 text-white text-sm font-extrabold rounded-xl shadow-md flex items-center gap-2 tracking-wide">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            បង្កើតលិខិតថ្មី
        </a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="table-toolbar animate-item-1">
        <h3 class="toolbar-title">ទិន្នន័យលិខិតធានាអះអាង</h3>
    </div>

    <div class="table-card animate-item-2">
        <div class="table-scroll">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">ល.រ</th>
                        <th class="text-left">ឈ្មោះបុគ្គលិក</th>
                        <th class="text-left">តួនាទី</th>
                        <th class="text-left">សាខា</th>
                        <th class="text-center">ចំនួនសម្ភារៈ</th>
                        <th class="text-left">កាលបរិច្ឆេទ</th>
                        <th class="text-center">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($handovers as $index => $handover)
                    <tr>
                        <td class="row-index text-left">{{ $index + 1 }}</td>
                        <td class="row-name text-left">{{ $handover->employee_name }}</td>
                        <td class="text-left">{{ $handover->position ?? 'N/A' }}</td>
                        <td class="text-left">
                            <span class="branch-pill">{{ $handover->branch }}</span>
                        </td>
                        <td class="text-center">
                            <span class="count-badge">{{ $handover->items->count() }}</span>
                        </td>
                        <td class="text-left">{{ \Carbon\Carbon::parse($handover->handover_date)->format('d/m/Y') }}</td>
                        
                        {{-- ជួរឈរ សកម្មភាព (Action Buttons) ដែលមានសោភ័ណភាព --}}
                        <td>
                            <div class="action-group">
                                {{-- ប៊ូតុង Print --}}
                                <a href="{{ route('admin.assets.show', $handover->id) }}" target="_blank" class="btn-action btn-print" title="បោះពុម្ពឯកសារ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Print
                                </a>
                                
                                {{-- ប៊ូតុង Edit --}}
                                <a href="{{ route('admin.assets.edit', $handover->id) }}" class="btn-action btn-edit" title="កែប្រែទិន្នន័យ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                
                                {{-- ប៊ូតុង Delete --}}
                                <form action="{{ route('admin.assets.destroy', $handover->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបលិខិតនេះមែនទេ? ទិន្នន័យសម្ភារៈទាំងអស់នឹងត្រូវបាត់បង់។');" class="inline-block m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="លុបទិន្នន័យចោល">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p>មិនទាន់មានទិន្នន័យនៅឡើយទេ</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection