@extends('layouts.admin')

@section('title', 'System Access Control | TF Admin')
@section('header_title', 'គ្រប់គ្រងគណនី (User Management)')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&family=Noto+Sans+Khmer:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0d1117;
            --console: #141a24;
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

        #userRegistry * { font-family: 'Inter', 'Noto Sans Khmer', sans-serif; }
        #userRegistry .font-display { font-family: 'Rajdhani', 'Noto Sans Khmer', sans-serif; }
        #userRegistry .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Console Header */
        .console {
            position: relative;
            background: radial-gradient(ellipse 120% 100% at 15% 0%, rgba(255,106,61,0.10) 0%, transparent 55%),
                        radial-gradient(ellipse 120% 100% at 100% 100%, rgba(61,139,255,0.14) 0%, transparent 55%),
                        linear-gradient(180deg, var(--console) 0%, var(--ink) 100%);
            overflow: hidden; border: 1px solid rgba(255,255,255,0.06);
        }
        .console::before {
            content: ""; position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: radial-gradient(ellipse 90% 90% at 30% 30%, black 20%, transparent 75%);
        }
        .console-plate {
            display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.10); padding: 0.35rem 0.9rem 0.35rem 0.6rem; border-radius: 999px;
        }
        .console-plate .dot {
            width: 8px; height: 8px; border-radius: 999px; background: var(--circuit);
            box-shadow: 0 0 0 3px var(--circuit-dim); animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot { 0%, 100% { opacity: 1; box-shadow: 0 0 0 3px var(--circuit-dim); } 50% { opacity: 0.6; box-shadow: 0 0 0 6px transparent; } }
        
        .btn-ignition {
            background: linear-gradient(180deg, var(--circuit) 0%, #2563eb 100%);
            box-shadow: 0 6px 20px -6px rgba(61,139,255,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .btn-ignition:hover { transform: translateY(-2px); box-shadow: 0 10px 26px -6px rgba(61,139,255,0.65), inset 0 1px 0 rgba(255,255,255,0.25); }

        /* Table Design */
        .ledger-wrap { background: #fff; border: 1px solid var(--line); border-radius: 1.5rem; }
        .dt-search input { border-radius: 0.75rem !important; border: 1px solid var(--line) !important; padding: 0.55rem 1.1rem !important; min-width: 260px; background-color: var(--paper); }
        .dt-search input:focus { border-color: var(--circuit) !important; box-shadow: 0 0 0 3px var(--circuit-dim) !important; background-color: #fff; outline: none !important; }
        .dt-length select { border-radius: 0.75rem !important; border: 1px solid var(--line) !important; padding: 0.4rem 2rem 0.4rem 1rem !important; background-color: var(--paper); }
        
        table.dataTable th { border-bottom: 2px solid var(--line) !important; color: #64748b; font-weight: 700; font-size: 10.5px; letter-spacing: 0.06em; }
        table.dataTable td { border-bottom: 1px solid #f1f3f6 !important; vertical-align: middle !important; }
        table.dataTable tbody tr:hover { background-color: #fafbfc !important; }
        
        .role-badge { padding: 0.32rem 0.7rem; border-radius: 999px; font-size: 10px; font-weight: 700; letter-spacing: 0.07em; display: inline-flex; align-items: center; gap: 0.4rem; }
        .role-admin { background: var(--circuit-dim); color: #1d4ed8; border: 1px solid #bfdbfe; }
        .role-staff { background: var(--signal-green-dim); color: #047857; border: 1px solid #a7f3d0; }
        
        .op-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 0.65rem; background: var(--paper); border: 1px solid var(--line); color: #64748b; transition: all 0.18s; }
        .op-btn:hover { transform: translateY(-2px); }
        .op-btn.edit:hover { background: var(--circuit-dim); color: var(--circuit); border-color: #b9d3ff; }
        .op-btn.del:hover { background: #ffe4e0; color: #dc4a3a; border-color: #ffc9c1; }
        .op-btn.disabled { opacity: 0.4; cursor: not-allowed; }
        .op-btn.disabled:hover { transform: none; background: var(--paper); color: #64748b; border-color: var(--line); }
    </style>
@endpush

@section('content')
<div id="userRegistry" class="w-full">

    <div class="console rounded-3xl p-6 md:p-8 text-white shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="relative text-center md:text-left z-10">
            <div class="console-plate mb-3">
                <span class="dot"></span>
                <span class="font-mono text-[11px] tracking-widest text-slate-300">SECURITY & ACCESS CONTROL</span>
            </div>
            <h1 class="font-display text-3xl md:text-4xl font-bold tracking-tight text-white uppercase">
                System Users
            </h1>
            <p class="font-mono text-[13px] text-slate-400 mt-2 tracking-wide">Manage administrative and staff access levels.</p>
        </div>
        
        <a href="{{ route('admin.users.create') }}" class="btn-ignition relative z-10 inline-flex items-center gap-2 text-white px-6 py-3.5 rounded-xl font-bold transition-all duration-300 whitespace-nowrap">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
            NEW SYSTEM USER
        </a>
    </div>

    <div class="ledger-wrap p-6 md:p-8 w-full">
        <div class="overflow-x-auto w-full">
            <table id="userTable" class="w-full whitespace-nowrap text-left text-sm text-slate-600 display">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px] tracking-wider">
                    <tr>
                        <th class="px-5 py-4 rounded-tl-xl border-r border-slate-100"># UID</th>
                        <th class="px-5 py-4">Account Information</th>
                        <th class="px-5 py-4 text-center">Access Role</th>
                        <th class="px-5 py-4 text-center">Created Date</th>
                        <th class="px-5 py-4 text-center rounded-tr-xl border-l border-slate-100">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                    <tr class="group">
                        <td class="px-5 py-4 font-mono text-slate-400 font-semibold border-r border-slate-50">
                            {{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-display font-bold text-lg text-slate-500 border border-slate-200">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-base">{{ $user->name }}
                                        @if(auth()->user()->id == $user->id)
                                            <span class="ml-2 text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-md border border-slate-200">YOU</span>
                                        @endif
                                    </div>
                                    <div class="text-[13px] text-slate-500 mt-0.5">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-center">
                            @php $roleName = $user->roles->first()->name ?? 'No Role'; @endphp
                            
                            @if($roleName == 'Admin')
                                <span class="role-badge role-admin">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    ADMINISTRATOR
                                </span>
                            @else
                                <span class="role-badge role-staff">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    GENERAL STAFF
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center font-mono text-[13px] text-slate-500">
                            {{ $user->created_at->format('d M Y - H:i') }}
                        </td>
                        <td class="px-5 py-4 border-l border-slate-50">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.edit', encrypt($user->id)) }}" class="op-btn edit" title="Edit Access">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                </a>
                                
                                @if(auth()->user()->id == $user->id)
                                    <button type="button" class="op-btn disabled" title="Cannot delete your own active session">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18"/><path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-13"/></svg>
                                    </button>
                                @else
                                    <form action="{{ route('admin.users.destroy', encrypt($user->id)) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-delete-modern op-btn del" title="Revoke Access">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16"/><path d="M9 7V4h6v3"/><path d="M6 7l1 13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-13"/><path d="M10 11v6M14 11v6"/></svg>
                                        </button>
                                    </form>
                                @endif
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
            $('#userTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'desc']],
                language: { search: "", searchPlaceholder: "🔍 Search users..." },
                layout: { topStart: 'pageLength', topEnd: 'search', bottomStart: 'info', bottomEnd: 'paging' }
            });

            $('.btn-delete-modern').on('click', function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Revoke Access?',
                    text: "This user will immediately lose all system privileges.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc4a3a',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Yes, Revoke',
                    borderRadius: '16px'
                }).then((result) => { if (result.isConfirmed) form.submit(); });
            });

            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'System Updated', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false, borderRadius: '16px' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Action Denied', text: "{{ session('error') }}", showConfirmButton: true, confirmButtonColor: '#dc4a3a', borderRadius: '16px' });
            @endif
        });
    </script>
@endpush