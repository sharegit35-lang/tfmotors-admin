@extends('layouts.admin')
@section('title', 'Car Requests | TF Admin')
@section('header_title', 'សំណើសុំរថយន្ត')

@push('styles')
<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Entrance Animation */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-wrap { animation: fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    /* Fix Laravel Default Pagination to match Tailwind */
    .pagination { display: flex; padding-left: 0; list-style: none; margin: 0; gap: 0.25rem; }
    .page-item .page-link {
        position: relative; display: block; padding: 0.5rem 0.75rem; font-size: 0.875rem;
        font-weight: 500; color: #64748b; background-color: #f8fafc; border: 1px solid #e2e8f0;
        border-radius: 0.5rem; transition: all 0.2s; text-decoration: none;
    }
    .page-item.active .page-link {
        z-index: 3; color: #fff; background-color: #0f2b3d; border-color: #0f2b3d;
    }
    .page-item.disabled .page-link {
        color: #94a3b8; pointer-events: none; background-color: #f1f5f9; border-color: #e2e8f0;
    }
    .page-item .page-link:hover:not(.disabled) {
        background-color: #e2e8f0; color: #0f2b3d;
    }
</style>
@endpush

@section('content')
<div class="w-full animate-wrap">

    <!-- Hero Banner (Full Width) -->
    <div class="w-full bg-gradient-to-br from-[#0a1f2c] to-[#123447] rounded-2xl p-6 md:p-8 text-white relative overflow-hidden mb-6 shadow-lg shadow-slate-200/50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2 h-2 rounded-full bg-blue-400 shadow-[0_0_8px_rgba(96,165,250,0.8)]"></span>
                    <span class="text-xs font-bold tracking-widest text-blue-200 uppercase">Logistics & Transport</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-1">CAR REQUESTS</h1>
                <p class="text-slate-400 text-sm font-medium">Manage and approve employee vehicle requests efficiently.</p>
            </div>
            
            <!-- Statistics Header Widget -->
            <div class="bg-white/10 border border-white/20 backdrop-blur-md rounded-xl px-5 py-3 flex items-center gap-4">
                <div class="text-center border-r border-white/20 pr-4">
                    <div class="text-2xl font-black text-amber-300">{{ $requests->where('status', 'Pending')->count() }}</div>
                    <div class="text-[10px] text-slate-300 uppercase tracking-wider">Pending</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-black text-emerald-400">{{ $requests->where('status', 'Approved')->count() }}</div>
                    <div class="text-[10px] text-slate-300 uppercase tracking-wider">Approved</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Main Table Container -->
    <div class="w-full bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Table Toolbar -->
        <div class="px-6 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4 bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-500">Show</span>
                <select class="text-sm border-slate-200 rounded-lg text-slate-700 font-medium focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm px-3 py-1.5 outline-none">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="text-sm font-medium text-slate-500">entries</span>
            </div>
            
            <div class="relative w-full md:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-slate-400 text-sm"></i>
                </div>
                <input type="text" class="bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 p-2 shadow-sm outline-none transition-all" placeholder="Search requests...">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 font-bold"># ID</th>
                        <th class="px-6 py-4 font-bold">Requester Info</th>
                        <th class="px-6 py-4 font-bold">Trip Details</th>
                        <th class="px-6 py-4 font-bold">Schedule</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($requests as $req)
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        
                        <!-- ID -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-mono text-xs font-bold text-slate-400 group-hover:text-blue-600 transition-colors">
                                #{{ str_pad($req->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>

                        <!-- User Info -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-[#0a1f2c] to-[#123447] text-white flex items-center justify-center font-bold shadow-md shadow-slate-200">
                                    {{ strtoupper(substr($req->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800">{{ $req->name }}</div>
                                    <div class="text-xs font-medium text-slate-500 flex items-center gap-1 mt-0.5">
                                        <i class="fas fa-building text-slate-400"></i> {{ $req->department }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Destination & Purpose -->
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 flex items-center gap-1.5 mb-1">
                                <i class="fas fa-map-marker-alt text-rose-500"></i> {{ $req->destination }}
                            </div>
                            <div class="text-xs text-slate-500 max-w-[200px] truncate" title="{{ $req->purpose }}">
                                {{ $req->purpose }}
                            </div>
                        </td>

                        <!-- Schedule -->
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2">
                                <!-- Departure -->
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex-shrink-0">
                                        <i class="fas fa-plane-departure text-[10px]"></i>
                                    </div>
                                    <div class="w-24 text-xs font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($req->start_time)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs font-bold text-blue-700 bg-blue-100/50 px-2 py-0.5 rounded tabular-nums">
                                        {{ \Carbon\Carbon::parse($req->start_time)->format('H:i') }}
                                    </div>
                                </div>
                                <!-- Arrival -->
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex-shrink-0">
                                        <i class="fas fa-flag-checkered text-[10px]"></i>
                                    </div>
                                    <div class="w-24 text-xs font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($req->end_time)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs font-bold text-emerald-700 bg-emerald-100/50 px-2 py-0.5 rounded tabular-nums">
                                        {{ \Carbon\Carbon::parse($req->end_time)->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(strtolower($req->status) == 'approved')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <i class="fas fa-check-circle"></i> APPROVED
                                </span>
                            @elseif(strtolower($req->status) == 'rejected')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                    <i class="fas fa-times-circle"></i> REJECTED
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    <i class="fas fa-clock"></i> PENDING
                                </span>
                            @endif
                        </td>

                        <!-- Operations / Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if(strtolower($req->status) == 'pending')
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Approve -->
                                    <form action="{{ route('admin.requests.status', $req->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" onclick="return confirm('Approve this car request?')"
                                                class="w-8 h-8 rounded-full flex items-center justify-center bg-white border border-emerald-200 text-emerald-600 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all shadow-sm" title="Approve">
                                            <i class="fas fa-check text-sm"></i>
                                        </button>
                                    </form>
                                    <!-- Reject -->
                                    <form action="{{ route('admin.requests.status', $req->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" onclick="return confirm('Reject this car request?')"
                                                class="w-8 h-8 rounded-full flex items-center justify-center bg-white border border-rose-200 text-rose-600 hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all shadow-sm" title="Reject">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                                    <i class="fas fa-lock"></i> Locked
                                </span>
                            @endif
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <i class="fas fa-inbox text-2xl"></i>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 mb-1">No Requests Found</h3>
                            <p class="text-sm text-slate-500">There are no vehicle requests matching your criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Pagination -->
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
            <div class="text-sm font-medium text-slate-500">
                Showing <span class="font-bold text-slate-800">{{ $requests->firstItem() ?? 0 }}</span> to <span class="font-bold text-slate-800">{{ $requests->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-800">{{ $requests->total() }}</span> entries
            </div>
            <div>
                {{ $requests->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>
@endsection