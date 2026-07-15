<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#7f1d1d">
    <title>Wedding RSVP Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bayon&family=Inter:wght@400;500;600;700;800&display=swap');

        :root{
            --color-red-deep:#7f1d1d;
            --color-red-main:#b91c1c;
            --color-gold:#d4af37;
            --color-gold-deep:#a9821f;
            --bg-page:#f7f5f3;
            --border-soft:#eee7e2;
        }

        body{ font-family:'Inter', sans-serif; background: var(--bg-page); color:#3f1818; -webkit-font-smoothing:antialiased; }
        .font-khmer{ font-family:'Bayon', cursive; }

        .card{ background:#fff; border:1px solid var(--border-soft); border-radius:1rem; box-shadow: 0 1px 2px rgba(0,0,0,.03), 0 8px 24px -16px rgba(127,29,29,.12); }

        .hero-card{
            background: linear-gradient(135deg, var(--color-red-main) 0%, var(--color-red-deep) 100%);
            border-radius:1rem; position:relative; overflow:hidden;
            box-shadow: 0 12px 30px -12px rgba(127,29,29,.45);
        }
        .hero-card::before{
            content:''; position:absolute; width:180px; height:180px; border-radius:50%;
            background: rgba(255,255,255,.08); top:-60px; right:-60px;
        }
        .hero-card::after{
            content:''; position:absolute; width:120px; height:120px; border-radius:50%;
            background: rgba(212,175,55,.18); bottom:-40px; left:-30px;
        }

        .icon-badge{ width:2.5rem; height:2.5rem; border-radius:.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0; }

        .live-dot{ width:7px; height:7px; border-radius:50%; background:#22c55e; position:relative; }
        .live-dot::after{ content:''; position:absolute; inset:0; border-radius:50%; background:#22c55e; animation: pulseDot 1.8s ease-out infinite; }
        @keyframes pulseDot{ 0%{ transform:scale(1); opacity:.7; } 100%{ transform:scale(2.6); opacity:0; } }

        .filter-chip{
            padding:.4rem .85rem; border-radius:9999px; font-size:.75rem; font-weight:600;
            border:1px solid var(--border-soft); background:#fff; color:#78716c;
            white-space:nowrap; transition: all .15s ease; cursor:pointer;
        }
        .filter-chip:hover{ border-color: var(--color-red-main); color: var(--color-red-main); }
        .filter-chip.active{ background: var(--color-red-main); border-color: var(--color-red-main); color:#fff; }

        .avatar{
            width:2.25rem; height:2.25rem; border-radius:50%; flex-shrink:0;
            background: linear-gradient(135deg, var(--color-red-main), var(--color-red-deep));
            color:#fff; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.8rem; text-transform:uppercase;
        }

        table{ border-collapse:separate; border-spacing:0; }
        thead th{ position:sticky; top:0; z-index:1; background:#fafaf9; }

        .no-scrollbar::-webkit-scrollbar{ display:none; }
        .no-scrollbar{ -ms-overflow-style:none; scrollbar-width:none; }

        @media print{
            body{ background:#fff; }
            .no-print{ display:none !important; }
            .card, .hero-card{ box-shadow:none !important; border:1px solid #e5e5e5 !important; }
            .hero-card{ background:#fff !important; color:#000 !important; }
        }
    </style>
</head>
<body class="p-4 md:p-8">
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="live-dot"></span>
                    <span class="text-[11px] uppercase tracking-[0.15em] font-semibold text-gray-400">ទិន្នន័យផ្ទាល់</span>
                </div>
                <h1 class="font-khmer text-2xl sm:text-3xl font-bold text-gray-800">ផ្ទាំងគ្រប់គ្រងភ្ញៀវកិត្តិយស</h1>
                <p class="text-gray-500 mt-1">មង្គលការ ពេជ្រ &amp; ធីតា 💍</p>
            </div>
            <button onclick="window.print()" class="no-print inline-flex items-center gap-2 self-start sm:self-auto bg-white border border-[var(--border-soft)] text-gray-600 hover:text-[var(--color-red-main)] hover:border-[var(--color-red-main)] font-semibold text-sm px-4 py-2.5 rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z"/></svg>
                បោះពុម្ព
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <div class="hero-card text-white p-6">
                <div class="relative flex items-start justify-between">
                    <div>
                        <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] opacity-80 mb-2">ចំនួនភ្ញៀវសរុប</h3>
                        <div class="text-4xl font-extrabold leading-none">
                            {{ $totalGuests }} <span class="text-base font-medium opacity-80">នាក់</span>
                        </div>
                    </div>
                    <div class="icon-badge bg-white/15">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1M9 11a3 3 0 100-6 3 3 0 000 6zM23 20v-1a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.15em] mb-2">មកម្នាក់ឯង</h3>
                        <div class="text-3xl font-extrabold text-gray-800">
                            {{ $comeOne }} <span class="text-base text-gray-400 font-medium">នាក់</span>
                        </div>
                    </div>
                    <div class="icon-badge bg-red-50 text-[var(--color-red-main)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a4 4 0 100-8 4 4 0 000 8zM4 20c0-4 3.6-6 8-6s8 2 8 6"/></svg>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.15em] mb-2">មក ២ នាក់</h3>
                        <div class="text-3xl font-extrabold text-gray-800">
                            {{ $comeTwo }} <span class="text-base text-gray-400 font-medium">គូ</span>
                        </div>
                    </div>
                    <div class="icon-badge bg-amber-50 text-[var(--color-gold-deep)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1M9 11a3 3 0 100-6 3 3 0 000 6zM23 20v-1a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                </div>
            </div>

            <div class="card p-6 border-red-100">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.15em] mb-2">មិនបានមក</h3>
                        <div class="text-3xl font-extrabold text-gray-400">
                            {{ $cannotCome }} <span class="text-base text-gray-300 font-medium">នាក់</span>
                        </div>
                    </div>
                    <div class="icon-badge bg-gray-100 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18zM9 9l6 6M15 9l-6 6"/></svg>
                    </div>
                </div>
            </div>

        </div>

        <div class="card overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 sm:p-5 border-b border-[var(--border-soft)] bg-[#fafaf9]">
                <div>
                    <h3 class="font-semibold text-gray-800">បញ្ជីឈ្មោះភ្ញៀវលម្អិត</h3>
                    <p class="text-xs text-gray-400 mt-0.5">បង្ហាញ <span id="visibleCount">{{ $allRsvps->count() }}</span> នៃ {{ $allRsvps->count() }} ភ្ញៀវ</p>
                </div>
                <div class="no-print flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <div class="relative sm:w-56">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input id="searchInput" type="text" placeholder="ស្វែងរកឈ្មោះភ្ញៀវ..." class="w-full pl-9 pr-3 py-2.5 text-sm rounded-lg border border-[var(--border-soft)] focus:border-[var(--color-red-main)] focus:ring-4 focus:ring-red-50 outline-none transition">
                    </div>
                    <div class="flex gap-2 overflow-x-auto no-scrollbar">
                        <button class="filter-chip active" data-filter="all">ទាំងអស់</button>
                        <button class="filter-chip" data-filter="1">ម្នាក់ឯង</button>
                        <button class="filter-chip" data-filter="2">២ នាក់</button>
                        <button class="filter-chip" data-filter="0">អវត្តមាន</button>
                    </div>
                </div>
            </div>

            <div class="overflow-y-auto max-h-[560px]">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-500 text-xs border-b border-[var(--border-soft)]">
                            <th class="p-4 font-semibold">ឈ្មោះភ្ញៀវ</th>
                            <th class="p-4 font-semibold text-center whitespace-nowrap">ចំនួន (Pax)</th>
                            <th class="p-4 font-semibold text-right whitespace-nowrap">កាលបរិច្ឆេទ</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="rsvpTableBody">
                        @forelse($allRsvps as $rsvp)
                        <tr class="rsvp-row border-b border-gray-50 hover:bg-gray-50/70 transition" data-pax="{{ $rsvp->pax }}">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <span class="avatar">{{ mb_substr($rsvp->guest_name, 0, 1) }}</span>
                                    <span class="guest-name font-medium text-gray-800 break-words">{{ $rsvp->guest_name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if($rsvp->pax == 1)
                                    <span class="inline-block bg-red-50 text-[var(--color-red-main)] px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">ម្នាក់ឯង (1)</span>
                                @elseif($rsvp->pax == 2)
                                    <span class="inline-block bg-amber-50 text-[var(--color-gold-deep)] px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">២ នាក់ (2)</span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">អវត្តមាន</span>
                                @endif
                            </td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-600">{{ $rsvp->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $rsvp->created_at->format('h:i A') }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-12 text-center text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1M9 11a3 3 0 100-6 3 3 0 000 6z"/></svg>
                                មិនទាន់មានទិន្នន័យនៅឡើយទេ
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <p id="noMatchRow" class="hidden p-10 text-center text-gray-400 text-sm">មិនមានលទ្ធផលដូចការស្វែងរកទេ</p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const chips = document.querySelectorAll('.filter-chip');
            const rows = document.querySelectorAll('.rsvp-row');
            const visibleCountEl = document.getElementById('visibleCount');
            const noMatchRow = document.getElementById('noMatchRow');
            let activeFilter = 'all';

            function applyFilters() {
                const query = (searchInput?.value || '').trim().toLowerCase();
                let visible = 0;

                rows.forEach(function (row) {
                    const name = row.querySelector('.guest-name')?.textContent.toLowerCase() || '';
                    const pax = row.getAttribute('data-pax');
                    const matchesSearch = name.includes(query);
                    const matchesFilter = activeFilter === 'all' || pax === activeFilter;
                    const show = matchesSearch && matchesFilter;
                    row.classList.toggle('hidden', !show);
                    if (show) visible++;
                });

                if (visibleCountEl) visibleCountEl.textContent = visible;
                if (noMatchRow) noMatchRow.classList.toggle('hidden', !(rows.length > 0 && visible === 0));
            }

            if (searchInput) searchInput.addEventListener('input', applyFilters);

            chips.forEach(function (chip) {
                chip.addEventListener('click', function () {
                    chips.forEach(function (c) { c.classList.remove('active'); });
                    chip.classList.add('active');
                    activeFilter = chip.getAttribute('data-filter');
                    applyFilters();
                });
            });
        });
    </script>
</body>
</html>