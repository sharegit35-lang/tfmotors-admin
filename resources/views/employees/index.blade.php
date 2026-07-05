@extends('layouts.admin')

@section('title', 'Employee Registry | TF Admin')
@section('header_title', 'បញ្ជីបុគ្គលិក (Employee Registry)')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&family=Noto+Sans+Khmer:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0d1117;
            --console: #141a24;
            --console-2: #1b2331;
            --chrome: #cbd5e1;
            --ignition: #ff6a3d;
            --ignition-dim: rgba(255, 106, 61, 0.16);
            --circuit: #3d8bff;
            --circuit-dim: rgba(61, 139, 255, 0.14);
            --signal-green: #22c58b;
            --signal-green-dim: rgba(34, 197, 139, 0.14);
            --paper: #f7f8fa;
            --line: #e6e9ee;
        }

        #employeeRegistry * { font-family: 'Inter', 'Noto Sans Khmer', sans-serif; }
        #employeeRegistry .icon { display: inline-block; vertical-align: -0.14em; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        #employeeRegistry .font-display { font-family: 'Rajdhani', 'Noto Sans Khmer', sans-serif; }
        #employeeRegistry .font-mono { font-family: 'JetBrains Mono', monospace; }

        @media (prefers-reduced-motion: reduce) {
            #employeeRegistry *, #employeeRegistry *::before, #employeeRegistry *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
            }
        }

        /* ===== Dashboard Console Header ===== */
        .console {
            position: relative;
            background:
                radial-gradient(ellipse 120% 100% at 15% 0%, rgba(255,106,61,0.10) 0%, transparent 55%),
                radial-gradient(ellipse 120% 100% at 100% 100%, rgba(61,139,255,0.14) 0%, transparent 55%),
                linear-gradient(180deg, var(--console) 0%, var(--ink) 100%);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .console::before {
            content: "";
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: radial-gradient(ellipse 90% 90% at 30% 30%, black 20%, transparent 75%);
        }
        .console-sweep {
            position: absolute; top: 0; bottom: 0; width: 40%;
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.06) 45%, rgba(255,255,255,0.10) 50%, rgba(255,255,255,0.06) 55%, transparent 100%);
            transform: translateX(-120%) skewX(-12deg);
            animation: sweep 6s ease-in-out infinite;
            animation-delay: 0.6s;
        }
        @keyframes sweep {
            0% { transform: translateX(-120%) skewX(-12deg); }
            35% { transform: translateX(220%) skewX(-12deg); }
            100% { transform: translateX(220%) skewX(-12deg); }
        }
        .console-plate {
            display: inline-flex; align-items: center; gap: 0.6rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.10);
            padding: 0.35rem 0.9rem 0.35rem 0.6rem;
            border-radius: 999px;
        }
        .console-plate .dot {
            width: 8px; height: 8px; border-radius: 999px;
            background: var(--signal-green);
            box-shadow: 0 0 0 3px var(--signal-green-dim);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 3px var(--signal-green-dim); }
            50% { opacity: 0.6; box-shadow: 0 0 0 6px transparent; }
        }
        .btn-ignition {
            position: relative;
            background: linear-gradient(180deg, var(--ignition) 0%, #e5502a 100%);
            box-shadow: 0 6px 20px -6px rgba(255,106,61,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .btn-ignition:hover { transform: translateY(-2px); box-shadow: 0 10px 26px -6px rgba(255,106,61,0.65), inset 0 1px 0 rgba(255,255,255,0.25); }
        .btn-ignition:active { transform: translateY(0); }

        /* ===== Gauge Stat Cards ===== */
        .gauge-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            position: relative;
            overflow: hidden;
            opacity: 0;
            animation: rise 0.55s cubic-bezier(.22,1,.36,1) forwards;
        }
        .gauge-card:nth-of-type(1) { animation-delay: 0.05s; }
        .gauge-card:nth-of-type(2) { animation-delay: 0.15s; }
        .gauge-card:nth-of-type(3) { animation-delay: 0.25s; }
        @keyframes rise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .gauge-card::after {
            content: "";
            position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
            background: var(--bar-color, var(--circuit));
        }
        .gauge-ring { transform: rotate(-90deg); }
        .gauge-ring circle.track { stroke: #edf0f4; }
        .gauge-ring circle.fill {
            stroke-dasharray: 150.8; /* 2*pi*24 */
            stroke-dashoffset: 150.8;
            stroke-linecap: round;
            transition: stroke-dashoffset 1.1s cubic-bezier(.22,1,.36,1);
        }

        /* ===== Table / Service Ledger ===== */
        .ledger-wrap {
            background: #fff; border: 1px solid var(--line); border-radius: 1.5rem;
        }
        div.dt-container { font-family: inherit; font-size: 0.875rem; width: 100%; }

        @media (min-width: 768px) {
            .dt-layout-row { display: flex !important; justify-content: space-between !important; align-items: center !important; margin-bottom: 1.5rem !important; margin-top: 0.25rem !important; }
            .dt-layout-cell { flex: unset !important; }
        }

        .dt-search input {
            border-radius: 0.75rem !important; border: 1px solid var(--line) !important;
            padding: 0.55rem 1.1rem !important; outline: none !important; min-width: 260px;
            background-color: var(--paper); transition: all 0.2s; font-family: 'Inter', sans-serif !important;
        }
        .dt-search input:focus {
            border-color: var(--circuit) !important; box-shadow: 0 0 0 3px var(--circuit-dim) !important;
            background-color: #fff;
        }
        .dt-length select {
            border-radius: 0.75rem !important; border: 1px solid var(--line) !important;
            padding: 0.4rem 2rem 0.4rem 1rem !important; background-color: var(--paper);
        }

        table.dataTable { border-collapse: collapse !important; width: 100% !important; }
        table.dataTable th {
            border-bottom: 2px solid var(--line) !important;
            color: #64748b; font-weight: 700; font-size: 10.5px; letter-spacing: 0.06em;
        }
        table.dataTable td {
            border-bottom: 1px solid #f1f3f6 !important;
            vertical-align: middle !important;
            background-color: transparent !important;
        }
        table.dataTable tbody tr,
        table.dataTable tbody tr.odd,
        table.dataTable tbody tr.even {
            background-color: #fff !important;
            transition: background-color 0.2s;
            opacity: 0;
            animation: row-in 0.4s ease forwards;
        }
        table.dataTable tbody tr:hover,
        table.dataTable tbody tr.odd:hover,
        table.dataTable tbody tr.even:hover { background-color: #fafbfc !important; }
        @keyframes row-in { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

        .part-id {
            font-variant-numeric: tabular-nums;
            color: #94a3b8; font-weight: 600; letter-spacing: 0.02em;
        }
        tr.group:hover .part-id { color: var(--circuit); }

        .odo {
            font-variant-numeric: tabular-nums;
        }

        .led-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.32rem 0.7rem; border-radius: 999px;
            font-size: 10px; font-weight: 700; letter-spacing: 0.07em;
        }
        .led-badge .led {
            width: 6px; height: 6px; border-radius: 999px; flex-shrink: 0;
        }
        .led-joined { background: var(--signal-green-dim); color: #0d8f61; }
        .led-joined .led { background: var(--signal-green); box-shadow: 0 0 6px var(--signal-green); }
        .led-pending { background: var(--ignition-dim); color: #c94a26; }
        .led-pending .led { background: var(--ignition); box-shadow: 0 0 6px var(--ignition); animation: pulse-dot 1.4s ease-in-out infinite; }
        .led-other { background: #f1f3f6; color: #64748b; }
        .led-other .led { background: #94a3b8; }

        .op-btn {
            width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
            border-radius: 0.65rem; background: var(--paper); border: 1px solid var(--line);
            color: #64748b; transition: all 0.18s;
        }
        .op-btn:hover { transform: translateY(-2px); }
        .op-btn.edit:hover { background: var(--circuit-dim); color: var(--circuit); border-color: #b9d3ff; }
        .op-btn.del:hover { background: #ffe4e0; color: #dc4a3a; border-color: #ffc9c1; }
    </style>
@endpush

@section('content')

@php
    $totalStaff = $employees->count();
    $activeStaff = 0;
    $pendingStaff = 0;
    $today = \Carbon\Carbon::today();

    foreach($employees as $emp) {
        $joinDate = $emp->start_work ? \Carbon\Carbon::parse($emp->start_work) : null;
        $isJoined = $joinDate && ($joinDate->isPast() || $joinDate->isToday());

        if (strtolower($emp->status) == 'active' || strtolower($emp->status) == 'probation') {
            if ($isJoined) $activeStaff++;
            else $pendingStaff++;
        }
    }

    $activePct = $totalStaff > 0 ? round(($activeStaff / $totalStaff) * 100) : 0;
    $pendingPct = $totalStaff > 0 ? round(($pendingStaff / $totalStaff) * 100) : 0;
@endphp

<div id="employeeRegistry" class="w-full">

    <div class="console rounded-3xl p-6 md:p-8 text-white shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="console-sweep"></div>
        <div class="relative text-center md:text-left">
            <div class="console-plate mb-3">
                <span class="dot"></span>
                <span class="font-mono text-[11px] tracking-widest text-slate-300">FLEET REGISTRY · LIVE</span>
            </div>
            <h1 class="font-display text-3xl md:text-4xl font-bold tracking-tight text-white">
                <svg class="icon mr-2" style="color: var(--ignition); width: 30px; height: 30px;" viewBox="0 0 24 24"><path d="M3 13l1.5-4.5A2 2 0 0 1 6.4 7h11.2a2 2 0 0 1 1.9 1.5L21 13"/><path d="M3 13h18v4a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1H6v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-4z"/><circle cx="7" cy="17" r="1.6"/><circle cx="17" cy="17" r="1.6"/><path d="M3 13l2-2h14l2 2"/></svg>TF MOTORS <span class="text-slate-400 font-normal">(CAMBODIA) Co.,Ltd</span>
            </h1>
            <p id="sync-clock" class="font-mono text-[13px] text-slate-400 mt-2 tracking-wide">Initializing secure registry…</p>
        </div>
        
        @role('Admin')
        <a href="{{ route('admin.employees.create') }}" class="btn-ignition relative inline-flex items-center gap-2 text-white px-6 py-3.5 rounded-xl font-bold transition-all duration-300 whitespace-nowrap">
            <svg class="icon" style="width: 17px; height: 17px;" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg> NEW STAFF REGISTRATION
        </a>
        @endrole
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="gauge-card p-6" style="--bar-color: var(--circuit);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Personnel</p>
                    <h3 class="font-display text-4xl font-bold text-slate-800 odo" data-count="{{ $totalStaff }}">0</h3>
                    <p class="text-[11px] text-slate-400 mt-1">On the roster</p>
                </div>
                <svg class="gauge-ring" width="60" height="60" viewBox="0 0 60 60">
                    <circle class="track" cx="30" cy="30" r="24" stroke-width="6" fill="none"/>
                    <circle class="fill" cx="30" cy="30" r="24" stroke-width="6" fill="none" stroke="var(--circuit)" data-pct="100"/>
                </svg>
            </div>
        </div>

        <div class="gauge-card p-6" style="--bar-color: var(--signal-green);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Active / Joined</p>
                    <h3 class="font-display text-4xl font-bold text-emerald-600 odo" data-count="{{ $activeStaff }}">0</h3>
                    <p class="text-[11px] text-slate-400 mt-1">{{ $activePct }}% of total</p>
                </div>
                <svg class="gauge-ring" width="60" height="60" viewBox="0 0 60 60">
                    <circle class="track" cx="30" cy="30" r="24" stroke-width="6" fill="none"/>
                    <circle class="fill" cx="30" cy="30" r="24" stroke-width="6" fill="none" stroke="var(--signal-green)" data-pct="{{ $activePct }}"/>
                </svg>
            </div>
        </div>

        <div class="gauge-card p-6" style="--bar-color: var(--ignition);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Pending Join</p>
                    <h3 class="font-display text-4xl font-bold text-[var(--ignition)] odo" data-count="{{ $pendingStaff }}">0</h3>
                    <p class="text-[11px] text-slate-400 mt-1">{{ $pendingPct }}% of total</p>
                </div>
                <svg class="gauge-ring" width="60" height="60" viewBox="0 0 60 60">
                    <circle class="track" cx="30" cy="30" r="24" stroke-width="6" fill="none"/>
                    <circle class="fill" cx="30" cy="30" r="24" stroke-width="6" fill="none" stroke="var(--ignition)" data-pct="{{ $pendingPct }}"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="ledger-wrap p-6 md:p-8 w-full">
        <div class="overflow-x-auto w-full">
            <table id="employeeTable" class="w-full whitespace-nowrap text-left text-sm text-slate-600 display">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px] tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-4 rounded-tl-xl border-r border-slate-100"># ID</th>
                        <th class="px-5 py-4">Personnel Profile</th>
                        <th class="px-5 py-4">Role & Unit</th>
                        <th class="px-5 py-4">Branch Node</th>
                        <th class="px-5 py-4">Join Date</th>
                        <th class="px-5 py-4">Day Tracker</th>
                        <th class="px-5 py-4 text-center">Status</th>
                        <th class="px-5 py-4 text-center rounded-tr-xl border-l border-slate-100">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($employees as $index => $employee)
                    <tr class="group" style="animation-delay: {{ min($index * 0.035, 0.6) }}s;">
                        <td class="px-5 py-4 part-id font-mono border-r border-slate-50 transition-colors">#{{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-5 py-4">
                            <div class="font-extrabold text-slate-800 text-base group-hover:text-[var(--circuit)] transition-colors">{{ $employee->english_name }}</div>
                            <div class="text-[13px] text-slate-500 mt-0.5">{{ $employee->khmer_name }} ({{ strtoupper($employee->gender) }})</div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-bold text-slate-700">{{ $employee->position ?? '—' }}</div>
                            <div class="text-[10px] font-extrabold text-[var(--circuit)] mt-1 uppercase tracking-wide">{{ $employee->department_name }}</div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-bold text-slate-700">{{ $employee->branch_name ?? '—' }}</div>
                            <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wide font-mono">{{ $employee->branch_code ?? 'N/A' }}</div>
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-700">
                            {{ $employee->start_work ? \Carbon\Carbon::parse($employee->start_work)->format('d M Y') : 'TBD' }}
                        </td>

                        <td class="px-5 py-4">
                            @php
                                $today = \Carbon\Carbon::today();
                                $joinDate = $employee->start_work ? \Carbon\Carbon::parse($employee->start_work) : null;
                            @endphp

                            @if($joinDate)
                                @if($joinDate->isPast() || $joinDate->isToday())
                                    <span class="led-badge led-joined">
                                        <span class="led"></span> <span class="font-mono odo">{{ $joinDate->diffInDays($today) }}</span> DAYS TENURE
                                    </span>
                                @else
                                    <span class="led-badge led-pending">
                                        <span class="led"></span> <span class="font-mono odo">{{ $today->diffInDays($joinDate) }}</span> DAYS PENDING
                                    </span>
                                @endif
                            @else
                                <span class="text-slate-400 text-xs font-medium bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">No Date</span>
                            @endif
                        </td>

                        <td class="px-5 py-4 text-center">
                            @php $isJoined = $joinDate && ($joinDate->isPast() || $joinDate->isToday()); @endphp

                            @if(strtolower($employee->status) == "active" || strtolower($employee->status) == "probation")
                                @if($isJoined)
                                    <span class="led-badge led-joined">JOINED</span>
                                @else
                                    <span class="led-badge led-pending">PENDING</span>
                                @endif
                            @else
                                <span class="led-badge led-other">{{ strtoupper($employee->status) }}</span>
                            @endif
                        </td>

                        <td class="px-5 py-4 border-l border-slate-50">
                            <div class="flex items-center justify-center gap-2">
                                @role('Admin')
                                    <a href="{{ route('admin.employees.edit', encrypt($employee->id)) }}" class="op-btn edit" title="Edit Profile">
                                        <svg class="icon" style="width: 15px; height: 15px;" viewBox="0 0 24 24"><path d="M4 20l1-4.2L15.6 5.2a1.5 1.5 0 0 1 2.1 0l1.1 1.1a1.5 1.5 0 0 1 0 2.1L8.2 19l-4.2 1z"/><path d="M14.2 6.8l3 3"/></svg>
                                    </a>
                                    <form action="{{ route('admin.employees.destroy', encrypt($employee->id)) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-delete-modern op-btn del" title="Delete Record">
                                            <svg class="icon" style="width: 15px; height: 15px;" viewBox="0 0 24 24"><path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-13"/><path d="M10 11v6M14 11v6"/></svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wide px-2 py-1 bg-slate-100 border border-slate-200 rounded-md">View Only</span>
                                @endrole
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // បើកដំណើរការ DataTables ជាមួយ Tailwind Styling
            $('#employeeTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'desc']],
                language: { search: "", searchPlaceholder: "🔍 Search registry..." },
                layout: {
                    topStart: 'pageLength',
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                }
            });

            // Clock ដើរម៉ោង
            function updateClock() {
                const now = new Date();
                $('#sync-clock').text('SYSTEM ONLINE: ' + now.toLocaleString('en-GB', { weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit', second: '2-digit' }));
            }
            setInterval(updateClock, 1000); updateClock();

            // Gauge ring fill animation
            document.querySelectorAll('.gauge-ring .fill').forEach(function(circle) {
                const pct = parseFloat(circle.getAttribute('data-pct')) || 0;
                const circumference = 150.8;
                const offset = circumference - (pct / 100) * circumference;
                requestAnimationFrame(function() {
                    setTimeout(function() { circle.style.strokeDashoffset = offset; }, 150);
                });
            });

            // Odometer count-up animation for stat numbers
            document.querySelectorAll('.odo[data-count]').forEach(function(el) {
                const target = parseInt(el.getAttribute('data-count'), 10) || 0;
                const duration = 900;
                const start = performance.now();
                function tick(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(eased * target);
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });

            // ប៊ូតុងលុបទិន្នន័យ (SweetAlert)
            $('.btn-delete-modern').on('click', function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Authorize Deletion?',
                    text: "This record will be permanently purged from TF Motors database.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc4a3a',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Confirm Purge',
                    borderRadius: '16px'
                }).then((result) => { if (result.isConfirmed) form.submit(); });
            });

            // សារ Alert លោតពេល Save ជោគជ័យ
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Registry Updated',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    borderRadius: '16px'
                });
            @endif
        });
    </script>
@endpush