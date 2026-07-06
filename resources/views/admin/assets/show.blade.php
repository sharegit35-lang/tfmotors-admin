@extends('layouts.admin')

@section('title', 'Preview & Print | TF Admin')
@section('header_title', 'បោះពុម្ពលិខិតប្រគល់ទ្រព្យសម្បត្តិ')

@push('styles')
<style>
    :root {
        --accent-red: #c62828;
        --accent-red-dark: #b71c1c;
    }

    /* ---------- Screen styling ---------- */
    .page-shell { width: 100%; }

    .toolbar {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(100, 116, 139, 0.08);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
        transition: color 0.2s ease;
    }
    .back-link:hover { color: #334155; }

    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.5rem;
        background: linear-gradient(90deg, var(--accent-red), var(--accent-red-dark));
        color: #ffffff;
        font-weight: 700;
        border-radius: 0.65rem;
        box-shadow: 0 8px 18px -6px rgba(198, 40, 40, 0.4);
        transition: all 0.2s ease;
    }
    .btn-print:hover { transform: translateY(-2px); box-shadow: 0 12px 22px -6px rgba(198, 40, 40, 0.45); }

    .page-viewport {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 2.5rem;
        display: flex;
        justify-content: center;
    }

    .a4-page {
        width: 210mm;
        min-height: 297mm;
        background: #ffffff;
        padding: 20mm;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        color: #000;
        margin: 0 auto;
        font-family: 'Khmer OS Siemreap', 'Battambang', sans-serif;
        box-sizing: border-box;
    }

    .print-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed; /* keeps columns within page width instead of growing with content */
    }
    .print-table th, .print-table td {
        border: 1px solid #444;
        padding: 8px;
        text-align: center;
        font-size: 13px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    .print-table th {
        background-color: #f8d7da;
        color: #b71c1c;
    }

    /* Column width hints so long descriptions/codes don't visually
       squeeze the other columns unevenly */
    .print-table th:nth-child(1), .print-table td:nth-child(1) { width: 6%; }
    .print-table th:nth-child(2), .print-table td:nth-child(2) { width: 30%; }
    .print-table th:nth-child(3), .print-table td:nth-child(3) { width: 16%; }
    .print-table th:nth-child(4), .print-table td:nth-child(4) { width: 10%; }
    .print-table th:nth-child(5), .print-table td:nth-child(5) { width: 20%; }
    .print-table th:nth-child(6), .print-table td:nth-child(6) { width: 18%; }

    /* =========================================================
       PRINT MODE — fixes:
       1) Extra blank page  -> remove all margins/padding from
          html/body and any wrapping containers, force @page size.
       2) Sidebar/topbar bleeding into print -> hide every layout
          element explicitly, not just assume .no-print catches it.
       3) Colors not printing (red table header) -> force exact
          color/background printing across browsers.
       4) Content cut off / spills to page 2 -> avoid rows/blocks
          splitting across the page break.
       ========================================================= */
    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: auto !important;
            background: #ffffff !important;
        }

        /* Visibility-based hiding: this is the reliable way to hide the
           admin shell (sidebar, topbar, breadcrumbs, wrapper divs, etc.)
           no matter how deeply layouts.admin nests them in the DOM.
           Hiding via display:none on specific parent selectors only
           works if you know the exact markup structure; visibility
           cascades correctly regardless of nesting depth. */
        body * {
            visibility: hidden !important;
        }
        #printArea, #printArea * {
            visibility: visible !important;
        }
        #printArea {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .a4-page {
            width: 210mm !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 15mm !important;
            box-shadow: none !important;
            box-sizing: border-box !important;
            page-break-after: auto;
        }

        /* Force background colors/text colors to actually print */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        /* Constrain the table to the page width instead of letting long
           content (names, model numbers, etc.) push columns wider than
           the printable area — this is what was cutting off the last
           column on the right edge. */
        .print-table {
            table-layout: fixed !important;
            width: 100% !important;
        }
        .print-table th,
        .print-table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal !important;
        }

        /* Keep table rows and signature block from splitting across pages */
        table, tr, td, th { page-break-inside: avoid; }
        .no-break { page-break-inside: avoid; }
    }
</style>
@endpush

@section('content')
<div class="page-shell print-root">

    {{-- Toolbar ខាងលើសម្រាប់ចុច Print (No Print Area) --}}
    <div class="toolbar no-print">
        <a href="{{ route('admin.assets.index') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            ត្រឡប់ទៅបញ្ជីវិញ
        </a>

        <button onclick="window.print()" class="btn-print">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Print ឯកសារឥឡូវនេះ
        </button>
    </div>

    {{-- ក្រដាស A4 សម្រាប់ Print --}}
    <div class="page-viewport" id="printArea">
        <div class="a4-page relative">
            <h3 class="text-center text-[16px] font-bold leading-relaxed">ព្រះរាជាណាចក្រកម្ពុជា<br>ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
            <h4 class="text-center text-[18px] font-bold mt-6 mb-8 text-[#c62828]">លិខិតធានាអះអាង</h4>

            <p class="text-[14px] leading-loose mb-4">
                ខ្ញុំបាទ/នាងខ្ញុំ ឈ្មោះ <span class="font-semibold text-blue-800">{{ $handover->employee_name }}</span><br> 
                មានតួនាទីជា <span class="font-semibold text-blue-800">{{ $handover->position ?? '...............................' }}</span><br>
                ដែលបំពេញការងារនៅសាខា <span class="font-semibold text-blue-800">{{ $handover->branch }}</span> នៃ ក្រុមហ៊ុន ធី អេហ្វម៉ូធ័រ (ខេមបូឌា) ឯ.ក។
            </p>

            <p class="text-[14px] leading-loose mb-4">
                ខ្ញុំបានទទួលសម្ភារៈ ឬ ឧបករណ៍មួយចំនួន (“ទ្រព្យសម្បត្តិ”) ដើម្បីប្រើប្រាស់ក្នុងការងារប្រចាំថ្ងៃសម្រាប់ផលប្រយោជន៍របស់ក្រុមហ៊ុន។ ទ្រព្យសម្បត្តិរួមមាន៖
            </p>

            <table class="print-table mb-6 no-break">
                <thead>
                    <tr>
                        <th class="w-12">ល.រ</th>
                        <th>បរិយាយ</th>
                        <th>S/N</th>
                        <th class="w-16">ចំនួន</th>
                        <th>លេខកូដសម្គាល់</th>
                        <th>ស្ថានភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($handover->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">{{ $item->description }}</td>
                        <td>{{ $item->serial_number }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->asset_code }}</td>
                        <td>{{ $item->condition }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="py-4 text-slate-400">មិនមានទិន្នន័យសម្ភារៈទេ</td></tr>
                    @endforelse
                </tbody>
            </table>

            <p class="text-[14px] leading-loose mb-4">
                នៅថ្ងៃផ្តិតស្នាមមេដៃលើលិខិតនេះ ខ្ញុំបាទ/នាងខ្ញុំ សូមអះអាងថា ខ្ញុំបានទទួលទ្រព្យសម្បត្តិទាំងនេះដោយគុណភាពល្អ គ្មានការខូចខាត។ ខ្ញុំយល់ព្រមទទួលខុសត្រូវតាមលក្ខខណ្ឌរបស់ក្រុមហ៊ុន។
            </p>

            <p class="text-[14px] leading-loose mb-2">ដូចនេះ ខ្ញុំបាទ/នាងខ្ញុំ យល់ព្រមនិងទទួលស្គាល់ថា ខ្ញុំបាទ/នាងខ្ញុំមានកាតព្វកិច្ចដូចខាងក្រោម៖</p>
            
            <ol class="text-[14px] leading-loose list-none pl-0 mb-6 space-y-1">
                <li>ក. ប្រើប្រាស់ និងគ្រប់គ្រងទ្រព្យសម្បត្តិដោយសុចរិត និងស្មោះត្រង់ ដើម្បីបំពេញការងារនិងផលប្រយោជន៍របស់ក្រុមហ៊ុន។</li>
                <li>ខ. ទទួលខុសត្រូវក្នុងការថែរក្សា និងការពារទ្រព្យសម្បត្តិពីការខូចខាត គ្រប់ពេលវេលា។</li>
                <li>គ. ទទួលខុសត្រូវចំពោះទង្វើណាមួយដែលអាចបង្កឲ្យមានឥទ្ធិពលអវិជ្ជមាន ឬ ប៉ះពាល់ដល់ក្រុមហ៊ុនដោយគោលបំណងមិនសមរម្យ ឬ ខុសច្បាប់។</li>
                <li>ឃ. មិនអាចលក់ ផ្ទេរ បញ្ចាំ ជួល ឬ ឲ្យអ្នកដទៃខ្ចីប្រើទ្រព្យសម្បត្តិនេះឡើយ។</li>
                <li>ង. ការផ្ទេរសិទ្ធិប្រើប្រាស់ ឬ គ្រប់គ្រងទៅឲ្យបុគ្គលិកផ្សេងទៀតអាចធ្វើបានតែបើមានការយល់ព្រមជាមុនពីប្រធាននាយកដ្ឋានហិរញ្ញវត្ថុ និងរដ្ឋបាល។</li>
                <li>ច. បើមានការខូចខាត បែកបាក់ ឬ បាត់បង់ទ្រព្យសម្បត្តិ ត្រូវជូនដំណឹងទៅថ្នាក់ដឹកនាំ និងនាយកដ្ឋានហិរញ្ញវត្ថុ និងរដ្ឋបាលជាមួយនឹងរបាយការណ៍ក្នុងរយៈពេលបី (០៣) ថ្ងៃ។</li>
                <li>ឆ. ត្រូវប្រគល់ទ្រព្យសម្បត្តិឲ្យក្រុមហ៊ុនភ្លាមៗ នៅពេលដែលមានការទាមទារដើម្បីត្រួតពិនិត្យ ជួសជុល ឬ ដកហូតជាបណ្តោះអាសន្ន ឬ អចិន្ត្រៃយ៍។</li>
            </ol>

            <div class="mt-16 flex justify-end text-[14px] no-break">
                <div class="text-center">
                    <p>ស្នាមមេដៃស្តាំ/ហត្ថលេខា</p>
                    <div class="h-24"></div>
                    <p>ឈ្មោះ៖ <span class="font-semibold text-blue-800">{{ $handover->employee_name }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection