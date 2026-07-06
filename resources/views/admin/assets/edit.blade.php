@extends('layouts.admin')

@section('title', 'កែប្រែលិខិតធានាអះអាង | TF Admin')
@section('header_title', 'កែប្រែលិខិតប្រគល់ទ្រព្យសម្បត្តិ')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<style>
    .ts-control { border-radius: 0.5rem; padding: 0.5rem 0.75rem; border-color: #cbd5e1; font-family: inherit; }
    .ts-control.focus { border-color: #c62828; box-shadow: 0 0 0 1px #c62828; }

    @media print {
        body * { visibility: hidden; }
        #printArea, #printArea * { visibility: visible; }
        #printArea { position: absolute; left: 0; top: 0; width: 210mm; margin: 0; padding: 15mm; }
        .no-print { display: none !important; }
        .a4-page { box-shadow: none !important; border: none !important; }
    }
    .a4-page { width: 210mm; min-height: 297mm; background: white; padding: 20mm; box-shadow: 0 10px 25px rgba(0,0,0,0.05); color: #000; margin: 0 auto; font-family: 'Khmer OS Siemreap', 'Battambang', sans-serif; }
    .print-table th, .print-table td { border: 1px solid #444; padding: 8px; text-align: center; font-size: 13px; }
    .print-table th { background-color: #f8d7da; color: #b71c1c; }
</style>
@endpush

@section('content')
<div class="flex flex-col xl:flex-row gap-6 items-start">

    {{-- Form កែប្រែទិន្នន័យ (Update Form) --}}
    <div class="w-full xl:w-1/3 bg-white rounded-2xl shadow-sm border border-slate-200 p-6 no-print sticky top-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-[#c62828]">កែប្រែប័ណ្ណប្រគល់ទ្រព្យ</h3>
            <a href="{{ route('admin.assets.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700">ត្រឡប់ក្រោយ</a>
        </div>
        
        <form id="assetForm" action="{{ route('admin.assets.update', $handover->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">ឈ្មោះបុគ្គលិក <span class="text-rose-500">*</span></label>
                <select name="employee_name" id="employeeSelect" required class="w-full bg-white" placeholder="— ស្វែងរក និងជ្រើសរើសបុគ្គលិក —">
                    <option value="">— ស្វែងរក និងជ្រើសរើសបុគ្គលិក —</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->english_name }}" {{ $handover->employee_name == $emp->english_name ? 'selected' : '' }}>
                            {{ $emp->english_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">តួនាទី</label>
                <input type="text" name="position" value="{{ $handover->position }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:border-[#c62828] outline-none" oninput="updatePreview()">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">សាខា <span class="text-rose-500">*</span></label>
                <select name="branch" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:border-[#c62828] outline-none" onchange="updatePreview()">
                    @php $branches = ['Head Quarters', 'MG Battambang', 'MG Siem Reap', 'MG 60 M', 'MG 50 M', 'Leap Motors']; @endphp
                    @foreach($branches as $branch)
                        <option value="{{ $branch }}" {{ $handover->branch == $branch ? 'selected' : '' }}>{{ $branch }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-sm font-bold text-slate-800">បញ្ជីទ្រព្យសម្បត្តិ</h4>
                    <button type="button" onclick="addAsset()" class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded hover:bg-emerald-100">+ បន្ថែមថ្មី</button>
                </div>
                
                <div id="assetList" class="space-y-4 max-h-[40vh] overflow-y-auto pr-2">
                    {{-- Loop បង្ហាញអីវ៉ាន់ចាស់ៗដែលបាន Save --}}
                    @foreach($handover->items as $index => $item)
                        @php $i = $index + 1; @endphp
                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 relative">
                            <div class="absolute top-2 right-2 px-2 py-0.5 bg-slate-200 text-xs font-bold rounded text-slate-500">#{{ $i }}</div>
                            <div class="space-y-3 mt-2">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 uppercase">បរិយាយ</label>
                                    <input type="text" name="description_{{ $i }}" value="{{ $item->description }}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">S/N</label>
                                        <input type="text" name="serial_{{ $i }}" value="{{ $item->serial_number }}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">ចំនួន</label>
                                        <input type="number" name="quantity_{{ $i }}" value="{{ $item->quantity }}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">កូដសម្គាល់</label>
                                        <input type="text" name="code_{{ $i }}" value="{{ $item->asset_code }}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none bg-emerald-50 text-emerald-700 font-semibold" oninput="updatePreview()">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">ស្ថានភាព</label>
                                        <input type="text" name="condition_{{ $i }}" value="{{ $item->condition }}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-2">
                <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                    រក្សាទុកការកែប្រែ (Update)
                </button>
            </div>
        </form>
    </div>

    {{-- A4 Preview Section --}}
    <div class="w-full xl:w-2/3 flex justify-center overflow-x-auto pb-10" id="printArea">
        <div class="a4-page relative">
            <h3 class="text-center text-[16px] font-bold">ព្រះរាជាណាចក្រកម្ពុជា<br>ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
            <h4 class="text-center text-[18px] font-bold mt-6 mb-8 text-[#c62828]">លិខិតធានាអះអាង</h4>

            <p class="text-[14px] leading-loose mb-4">
                ខ្ញុំបាទ/នាងខ្ញុំ ឈ្មោះ <span id="prevName" class="font-semibold text-blue-800">{{ $handover->employee_name }}</span><br> 
                មានតួនាទីជា <span id="prevPosition" class="font-semibold text-blue-800">{{ $handover->position }}</span><br>
                ដែលបំពេញការងារនៅសាខា <span id="prevBranch" class="font-semibold text-blue-800">{{ $handover->branch }}</span> នៃ ក្រុមហ៊ុន ធី អេហ្វម៉ូធ័រ (ខេមបូឌា) ឯ.ក។
            </p>

            <table class="w-full print-table mb-6">
                <thead>
                    <tr><th class="w-12">ល.រ</th><th>បរិយាយ</th><th>S/N</th><th class="w-16">ចំនួន</th><th>កូដសម្គាល់</th><th>ស្ថានភាព</th></tr>
                </thead>
                <tbody id="previewTbody">
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
                    <p>ឈ្មោះ៖ <span id="prevName2" class="font-semibold text-blue-800">{{ $handover->employee_name }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
    let assetIndex = {{ $handover->items->count() }};
    const assetList = document.getElementById('assetList');
    const previewTbody = document.getElementById('previewTbody');
    let tomSelectInstance;

    document.addEventListener('DOMContentLoaded', () => {
        tomSelectInstance = new TomSelect("#employeeSelect", {
            maxItems: 1,
            onChange: function() {
                updatePreview();
            }
        });
        updatePreview(); 
    });

    function generateAssetCode() {
        return 'AST-' + Math.floor(1000 + Math.random() * 9000);
    }

    function addAsset() {
        assetIndex++;
        const autoCode = generateAssetCode();
        const div = document.createElement('div');
        div.className = "bg-slate-50 p-3 rounded-lg border border-slate-200 relative";
        div.innerHTML = `
            <div class="absolute top-2 right-2 px-2 py-0.5 bg-slate-200 text-xs font-bold rounded text-slate-500">#${assetIndex}</div>
            <div class="space-y-3 mt-2">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase">បរិយាយ</label>
                    <input type="text" name="description_${assetIndex}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">S/N</label>
                        <input type="text" name="serial_${assetIndex}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">ចំនួន</label>
                        <input type="number" name="quantity_${assetIndex}" value="1" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded focus:border-[#c62828] outline-none" oninput="updatePreview()">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">កូដសម្គាល់</label>
                        <input type="text" name="code_${assetIndex}" value="${autoCode}" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded outline-none bg-emerald-50 text-emerald-700 font-semibold" oninput="updatePreview()">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase">ស្ថានភាព</label>
                        <input type="text" name="condition_${assetIndex}" value="ថ្មី" class="w-full px-2 py-1.5 text-sm border border-slate-300 rounded outline-none" oninput="updatePreview()">
                    </div>
                </div>
            </div>
        `;
        assetList.appendChild(div);
        updatePreview();
    }

    function updatePreview() {
        const employeeSelect = document.getElementById('employeeSelect');
        let name = '...............................';
        if(employeeSelect.selectedIndex !== -1 && employeeSelect.value !== '') {
            name = employeeSelect.options[employeeSelect.selectedIndex].text;
        }

        document.getElementById('prevName').textContent = name;
        document.getElementById('prevName2').textContent = name;
        document.getElementById('prevPosition').textContent = document.querySelector('[name="position"]').value || '...............................';
        document.getElementById('prevBranch').textContent = document.querySelector('[name="branch"]').value || '...............................';

        previewTbody.innerHTML = '';
        let count = 1;
        for (let i = 1; i <= assetIndex; i++) {
            const desc = document.querySelector(`[name="description_${i}"]`)?.value;
            if (!desc) continue;
            previewTbody.innerHTML += `
            <tr>
                <td>${count++}</td><td class="text-left">${desc}</td>
                <td>${document.querySelector(`[name="serial_${i}"]`)?.value || ''}</td>
                <td>${document.querySelector(`[name="quantity_${i}"]`)?.value || '1'}</td>
                <td>${document.querySelector(`[name="code_${i}"]`)?.value || ''}</td>
                <td>${document.querySelector(`[name="condition_${i}"]`)?.value || ''}</td>
            </tr>`;
        }
    }
</script>
@endpush