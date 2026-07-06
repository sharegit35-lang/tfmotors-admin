@extends('layouts.admin')

@section('title', 'បន្ថែមលិខិតធានាអះអាង | TF Admin')
@section('header_title', 'បង្កើតលិខិតប្រគល់ទ្រព្យសម្បត្តិ')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<style>
    :root {
        --accent-red: #c62828;
        --accent-red-dark: #b71c1c;
    }

    /* ---------- Entrance Animations ---------- */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    /* ---------- Full-width hero banner (matches other admin pages) ---------- */
    .page-shell { width: 100%; }

    .hero-banner {
        width: 100%;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: clamp(1rem, 0.5rem + 1vw, 1.75rem);
        padding: clamp(1.5rem, 1rem + 2vw, 2.5rem);
        position: relative;
        overflow: hidden;
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
        position: relative; z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #fca5a5;
        background: rgba(252, 165, 165, 0.1);
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        margin-bottom: 0.9rem;
    }
    .hero-badge .dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #f87171;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.25);
    }
    .hero-title {
        position: relative; z-index: 1;
        font-size: clamp(1.4rem, 1.1rem + 1.4vw, 2rem);
        font-weight: 800;
        color: #ffffff;
    }
    .hero-subtitle {
        position: relative; z-index: 1;
        color: #94a3b8;
        font-weight: 500;
        margin-top: 0.5rem;
        font-size: clamp(0.85rem, 0.8rem + 0.2vw, 0.95rem);
    }

    /* ---------- Left form panel ---------- */
    .form-panel {
        background: #ffffff;
        border-radius: 1.25rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 20px 40px -12px rgba(100, 116, 139, 0.14);
        overflow: hidden;
    }

    .panel-header {
        background: linear-gradient(135deg, var(--accent-red), var(--accent-red-dark));
        padding: 1.25rem 1.5rem;
        text-align: center;
    }
    .panel-header h3 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: 0.01em;
    }

    .panel-body {
        padding: 1.5rem;
    }

    .field-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.4rem;
    }

    .field-input {
        width: 100%;
        padding: 0.6rem 0.85rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.6rem;
        font-size: 0.9rem;
        color: #1e293b;
        background: #f8fafc;
        transition: all 0.2s ease;
        outline: none;
    }
    .field-input:focus {
        background: #ffffff;
        border-color: var(--accent-red);
        box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.12);
    }

    .ts-control { border-radius: 0.6rem; padding: 0.55rem 0.75rem; border-color: #cbd5e1; font-family: inherit; background: #f8fafc; }
    .ts-control.focus { border-color: var(--accent-red); box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.12); }

    .section-divider {
        border-top: 1px solid #f1f5f9;
        padding-top: 1.25rem;
        margin-top: 1.25rem;
    }

    .btn-add {
        font-size: 0.72rem;
        font-weight: 700;
        color: #059669;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        padding: 0.4rem 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }
    .btn-add:hover { background: #d1fae5; }

    /* ---------- Asset item card ---------- */
    .asset-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        padding: 0.9rem;
        position: relative;
        transition: box-shadow 0.2s ease;
    }
    .asset-card:hover { box-shadow: 0 4px 12px rgba(100, 116, 139, 0.1); }

    .asset-badge {
        position: absolute;
        top: 0.55rem; right: 0.55rem;
        padding: 0.15rem 0.55rem;
        background: #e2e8f0;
        color: #64748b;
        font-size: 0.65rem;
        font-weight: 800;
        border-radius: 0.4rem;
    }

    .mini-label {
        display: block;
        font-size: 0.65rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.2rem;
    }

    .mini-input {
        width: 100%;
        padding: 0.4rem 0.55rem;
        font-size: 0.82rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.45rem;
        outline: none;
        background: #ffffff;
        transition: border-color 0.2s ease;
    }
    .mini-input:focus { border-color: var(--accent-red); }

    .mini-input.code-input {
        background: #ecfdf5;
        color: #047857;
        font-weight: 700;
    }

    /* ---------- Submit buttons ---------- */
    .btn-primary {
        width: 100%;
        padding: 0.75rem;
        background: linear-gradient(90deg, var(--accent-red), var(--accent-red-dark));
        color: #ffffff;
        font-weight: 700;
        border-radius: 0.65rem;
        box-shadow: 0 8px 18px -6px rgba(198, 40, 40, 0.4);
        transition: all 0.25s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 22px -6px rgba(198, 40, 40, 0.45); }

    .btn-secondary {
        width: 100%;
        padding: 0.75rem;
        background: #f1f5f9;
        color: #334155;
        font-weight: 700;
        border-radius: 0.65rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .btn-secondary:hover { background: #e2e8f0; }

    /* 🖨 Print (A4 Format) */
    @media print {
        body * { visibility: hidden; }
        #printArea, #printArea * { visibility: visible; }
        #printArea { position: absolute; left: 0; top: 0; width: 210mm; margin: 0; padding: 15mm; }
        .no-print { display: none !important; }
        .a4-page { box-shadow: none !important; border: none !important; }
    }
    .a4-page { width: 210mm; min-height: 297mm; background: white; padding: 20mm; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); color: #000; margin: 0 auto; font-family: 'Khmer OS Siemreap', 'Battambang', sans-serif; }
    .print-table th, .print-table td { border: 1px solid #444; padding: 8px; text-align: center; font-size: 13px; }
    .print-table th { background-color: #f8d7da; color: #b71c1c; }
</style>
@endpush

@section('content')
<div class="page-shell">

    <div class="hero-banner animate-card no-print">
        <span class="hero-badge"><span class="dot"></span> លិខិតធានាអះអាង</span>
        <h1 class="hero-title">បង្កើតលិខិតប្រគល់ទ្រព្យសម្បត្តិ</h1>
        <p class="hero-subtitle">បំពេញព័ត៌មានបុគ្គលិក និងបញ្ជីទ្រព្យសម្បត្តិ ដើម្បីបង្កើតលិខិតធានាអះអាងថ្មី។</p>
    </div>

    <div class="flex flex-col xl:flex-row gap-6 items-start">

        {{-- ផ្នែកខាងឆ្វេង៖ Form បញ្ចូលទិន្នន័យ (No Print) --}}
        <div class="w-full xl:w-1/3 form-panel no-print sticky top-4">
            <div class="panel-header">
                <h3>ប័ណ្ណប្រគល់ទ្រព្យសម្បត្តិ</h3>
            </div>

            <form id="assetForm" action="{{ route('admin.assets.store') }}" method="POST" class="panel-body space-y-4">
                @csrf

                <div>
                    <label class="field-label">ឈ្មោះបុគ្គលិក <span class="text-rose-500">*</span></label>
                    <select name="employee_name" id="employeeSelect" required class="w-full bg-white" placeholder="— ស្វែងរក និងជ្រើសរើសបុគ្គលិក —">
                        <option value="">— ស្វែងរក និងជ្រើសរើសបុគ្គលិក —</option>
                        {{-- Loop បញ្ចូលឈ្មោះបុគ្គលិកពី Database --}}
                        @foreach($employees as $emp)
                            <option value="{{ $emp->english_name }}">{{ $emp->english_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="field-label">តួនាទី</label>
                    <input type="text" name="position" class="field-input" oninput="updatePreview()">
                </div>

                <div>
                    <label class="field-label">សាខា <span class="text-rose-500">*</span></label>
                    <select name="branch" required class="field-input" onchange="updatePreview()">
                        <option value="">— ជ្រើសរើសសាខា —</option>
                        <option value="Head Quarters">Head Quarters</option>
                        <option value="MG Battambang">MG Battambang</option>
                        <option value="MG Siem Reap">MG Siem Reap</option>
                        <option value="MG 60 M">MG 60 M</option>
                        <option value="MG 50 M">MG 50 M</option>
                        <option value="Leap Motors">Leap Motors</option>
                    </select>
                </div>

                <div class="section-divider">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-sm font-bold text-slate-800">បញ្ជីទ្រព្យសម្បត្តិ</h4>
                        <button type="button" onclick="addAsset()" class="btn-add">+ បន្ថែម</button>
                    </div>

                    <div id="assetList" class="space-y-3 max-h-[40vh] overflow-y-auto pr-2">
                        </div>
                </div>

                <div class="section-divider space-y-2">
                    <button type="submit" class="btn-primary">
                        រក្សាទុកទិន្នន័យ
                    </button>
                    <button type="button" onclick="window.print()" class="btn-secondary">
                        Print / PDF លិខិត
                    </button>
                </div>
            </form>
        </div>

        {{-- ផ្នែកខាងស្តាំ៖ A4 Preview --}}
        <div class="w-full xl:w-2/3 flex justify-center overflow-x-auto pb-10" id="printArea">
            <div class="a4-page relative">
                <h3 class="text-center text-[16px] font-bold leading-relaxed">ព្រះរាជាណាចក្រកម្ពុជា<br>ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
                <h4 class="text-center text-[18px] font-bold mt-6 mb-8 text-[#c62828]">លិខិតធានាអះអាង</h4>

                <p class="text-[14px] leading-loose mb-4">
                    ខ្ញុំបាទ/នាងខ្ញុំ ឈ្មោះ <span id="prevName" class="font-semibold text-blue-800">...............................</span><br> 
                    មានតួនាទីជា <span id="prevPosition" class="font-semibold text-blue-800">...............................</span><br>
                    ដែលបំពេញការងារនៅសាខា <span id="prevBranch" class="font-semibold text-blue-800">...............................</span> នៃ ក្រុមហ៊ុន ធី អេហ្វម៉ូធ័រ (ខេមបូឌា) ឯ.ក។
                </p>

                <p class="text-[14px] leading-loose mb-4">
                    ខ្ញុំបានទទួលសម្ភារៈ ឬ ឧបករណ៍មួយចំនួន (“ទ្រព្យសម្បត្តិ”) ដើម្បីប្រើប្រាស់ក្នុងការងារប្រចាំថ្ងៃសម្រាប់ផលប្រយោជន៍របស់ក្រុមហ៊ុន។ ទ្រព្យសម្បត្តិរួមមាន៖
                </p>

                <table class="w-full print-table mb-6">
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
                    <tbody id="previewTbody">
                        <tr><td colspan="6" class="py-4 text-slate-400">មិនទាន់មានទិន្នន័យទេ</td></tr>
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

                <div class="mt-16 flex justify-end text-[14px]">
                    <div class="text-center">
                        <p>ស្នាមមេដៃស្តាំ/ហត្ថលេខា</p>
                        <div class="h-24"></div>
                        <p>ឈ្មោះ៖ <span id="prevName2" class="font-semibold text-blue-800">...............................</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
    let assetIndex = 0;
    const assetList = document.getElementById('assetList');
    const previewTbody = document.getElementById('previewTbody');
    let tomSelectInstance;

    // ហៅ Tom Select ឲ្យដំណើរការ
    document.addEventListener('DOMContentLoaded', function() {
        tomSelectInstance = new TomSelect("#employeeSelect", {
            maxItems: 1,
            onChange: function() {
                updatePreview();
            }
        });
        addAsset();
    });

    // មុខងារបង្កើតលេខកូដស្វ័យប្រវត្តិ
    function generateAssetCode() {
        const randomNum = Math.floor(1000 + Math.random() * 9000); 
        return 'AST-' + randomNum;
    }

    function addAsset() {
        assetIndex++;
        const autoCode = generateAssetCode();

        const div = document.createElement('div');
        div.className = "asset-card";
        div.innerHTML = `
            <div class="asset-badge">#${assetIndex}</div>
            <div class="space-y-3 mt-2">
                <div>
                    <label class="mini-label">បរិយាយ</label>
                    <input type="text" name="description_${assetIndex}" class="mini-input" oninput="updatePreview()">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="mini-label">S/N</label>
                        <input type="text" name="serial_${assetIndex}" class="mini-input" oninput="updatePreview()">
                    </div>
                    <div>
                        <label class="mini-label">ចំនួន</label>
                        <input type="number" name="quantity_${assetIndex}" value="1" class="mini-input" oninput="updatePreview()">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="mini-label">កូដសម្គាល់</label>
                        <input type="text" name="code_${assetIndex}" value="${autoCode}" class="mini-input code-input" oninput="updatePreview()">
                    </div>
                    <div>
                        <label class="mini-label">ស្ថានភាព</label>
                        <input type="text" name="condition_${assetIndex}" value="ថ្មី" class="mini-input" oninput="updatePreview()">
                    </div>
                </div>
            </div>
        `;
        assetList.appendChild(div);
        updatePreview();
    }

    function updatePreview() {
        const employeeSelect = document.getElementById('employeeSelect');
        // ទាញយកអក្សរពិតប្រាកដដែលបានរើសក្នុង Select
        let name = '...............................';
        if(employeeSelect.selectedIndex !== -1 && employeeSelect.value !== '') {
            name = employeeSelect.options[employeeSelect.selectedIndex].text;
        }
        
        document.getElementById('prevName').textContent = name;
        document.getElementById('prevName2').textContent = name;
        document.getElementById('prevPosition').textContent = document.querySelector('[name="position"]').value || '...............................';
        document.getElementById('prevBranch').textContent = document.querySelector('[name="branch"]').value || '...............................';

        previewTbody.innerHTML = '';
        let hasData = false;
        let count = 1;

        for (let i = 1; i <= assetIndex; i++) {
            const desc = document.querySelector(`[name="description_${i}"]`)?.value;
            if (!desc) continue;
            
            hasData = true;
            const serial = document.querySelector(`[name="serial_${i}"]`)?.value || '';
            const qty = document.querySelector(`[name="quantity_${i}"]`)?.value || '1';
            const code = document.querySelector(`[name="code_${i}"]`)?.value || '';
            const condition = document.querySelector(`[name="condition_${i}"]`)?.value || '';

            previewTbody.innerHTML += `
            <tr>
                <td>${count++}</td>
                <td class="text-left">${desc}</td>
                <td>${serial}</td>
                <td>${qty}</td>
                <td>${code}</td>
                <td>${condition}</td>
            </tr>`;
        }

        if (!hasData) {
            previewTbody.innerHTML = '<tr><td colspan="6" class="py-4 text-slate-400">មិនទាន់មានទិន្នន័យទេ</td></tr>';
        }
    }
</script>
@endpush