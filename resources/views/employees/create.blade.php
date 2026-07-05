@extends('layouts.admin')

@section('title', 'Add New Employee | TF Admin')
@section('header_title', 'ចុះឈ្មោះបុគ្គលិកថ្មី')

@push('styles')
    <style>
        :root {
            --navy-deep: #0a1f2c;
            --navy: #0f2b3d;
            --navy-light: #123447;
            --gold: #d4af37;
            --gold-light: #f3d980;
        }

        .hd-text {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* Hero Banner Animation */
        .registry-hero {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, var(--navy-deep) 0%, var(--navy) 45%, var(--navy-light) 100%);
            background-size: 180% 180%; animation: heroDrift 14s ease infinite;
        }
        @keyframes heroDrift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .registry-hero::before {
            content: ""; position: absolute; border-radius: 9999px; pointer-events: none;
            width: 260px; height: 260px; right: -60px; top: -90px;
            background: radial-gradient(circle, rgba(212,175,55,0.22), transparent 70%);
            animation: pulseGlow 5s ease-in-out infinite;
        }
        @keyframes pulseGlow { 0%, 100% { opacity: 0.55; } 50% { opacity: 1; } }

        /* Premium Input Focus */
        .saas-input {
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }
        .saas-input:focus {
            background-color: #ffffff;
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15) !important;
        }
    </style>
@endpush

@section('content')
<div class="w-full hd-text">
    
    <div class="registry-hero rounded-3xl p-6 md:p-8 text-white shadow-lg mb-8 border border-slate-200">
        <div class="relative text-center md:text-left z-10">
            <p class="text-[11px] tracking-[0.25em] uppercase mb-1" style="color: var(--gold-light);">
                New Personnel Entry · ចុះឈ្មោះបុគ្គលិកថ្មី
            </p>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight drop-shadow-md">
                <i class="fa-solid fa-user-plus mr-3" style="color: var(--gold-light);"></i>TF MOTORS ACQUISITION
            </h1>
            <p class="mt-2 text-sm font-medium tracking-wide opacity-90" style="color: rgba(243,236,217,0.75);">
                Please accurately fill in the details below to register a new staff member into the central database.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-10 w-full mb-8">
        <form id="employeeForm" action="{{ route('admin.employees.store') }}" method="POST">
            @csrf
            
            <div class="mb-12">
                <h3 class="text-xs font-bold uppercase tracking-[0.15em] border-b-2 border-slate-100 pb-3 mb-6 flex items-center gap-2" style="color: var(--navy);">
                    <i class="fa-solid fa-address-card" style="color: var(--gold);"></i> I. Personal Profile
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Full Name (English)</label>
                        <input type="text" name="english_name" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none uppercase font-bold text-slate-800" placeholder="E.G. JOHN DOE" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Full Name (Khmer)</label>
                        <input type="text" name="khmer_name" id="khmerInput" maxlength="100" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800" placeholder="E.G. សុខ ជា" required>
                        <div class="text-right text-[10px] font-bold text-slate-400 mt-1.5" id="khmerCounter">0 / 100 Characters</div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Gender</label>
                        <select name="gender" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-medium text-slate-700" required>
                            <option value="" selected disabled>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-medium text-slate-700" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Contact Number</label>
                        <input type="tel" name="phone" id="phoneInput" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800 tracking-wider" placeholder="012 345 678" oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')" required>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <h3 class="text-xs font-bold uppercase tracking-[0.15em] border-b-2 border-slate-100 pb-3 mb-6 flex items-center gap-2" style="color: var(--navy);">
                    <i class="fa-solid fa-file-shield" style="color: var(--gold);"></i> II. Legal Documents
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">National ID Number</label>
                        <input type="text" name="identity_card" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800 tracking-wider" placeholder="E.G. 010234567" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Passport (Optional)</label>
                        <input type="text" name="cambodian_passport" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800 tracking-wider" placeholder="E.G. N1234567">
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <h3 class="text-xs font-bold uppercase tracking-[0.15em] border-b-2 border-slate-100 pb-3 mb-6 flex items-center gap-2" style="color: var(--navy);">
                    <i class="fa-solid fa-building-user" style="color: var(--gold);"></i> III. Corporate Deployment & Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Position / Role</label>
                        <input type="text" name="position" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800" placeholder="E.G. Senior Technician" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Department</label>
                        <input type="text" name="department_name" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-800" placeholder="E.G. After-Sales" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Corporate Branch</label>
                        <select name="branch_name" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-700" required>
                            <option value="" selected disabled>Select Branch</option>
                            <option value="Headquarters">Headquarters (Phnom Penh)</option>
                            <option value="Siem Reap Branch">Siem Reap Branch</option>
                            <option value="Battambang Branch">Battambang Branch</option>
                            <option value="MH">MH Service Center</option>
                            <option value="Vive Motors">Vive Motors</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Category Group</label>
                        <select name="branch_code" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-bold text-slate-700" required>
                            <option value="" selected disabled>Select Category</option>
                            <option value="2W">Automotive (2W)</option>
                            <option value="4W">Automotive (4W)</option>
                            <option value="Support">Corporate Support</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wide mb-2" style="color: var(--navy);">Effective Start Date</label>
                        <input type="date" name="start_work" id="joinDateInput" class="saas-input w-full rounded-xl px-4 py-3.5 text-sm outline-none font-bold text-slate-800" style="border: 1.5px solid var(--gold); background-color: rgba(212,175,55,0.05);" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Official Hire Date</label>
                        <input type="date" name="hire_date" class="saas-input w-full rounded-xl border-slate-200 px-4 py-3.5 text-sm outline-none font-medium text-slate-700" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Gross Salary (USD)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 font-bold text-slate-400">$</span>
                            <input type="number" step="0.01" name="salary" class="saas-input w-full rounded-xl border-slate-200 pl-8 pr-4 py-3.5 text-lg font-extrabold text-emerald-600 outline-none tabular" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">System Status Insight</label>
                        <div id="statusCard" class="w-full rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 flex flex-col items-center justify-center min-h-[90px] transition-all">
                            <span class="text-slate-400 text-sm font-medium">Select a start date to calculate...</span>
                        </div>
                        <input type="hidden" name="status" id="dbStatusValue" value="active">
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t border-slate-200">
                <button type="button" id="resetBtn" class="px-8 py-3.5 rounded-xl font-bold text-rose-500 bg-rose-50 hover:bg-rose-100 transition-all border border-rose-100">
                    <i class="fa-solid fa-rotate-right mr-2"></i> Reset
                </button>
                <a href="{{ route('admin.employees.index') }}" class="px-8 py-3.5 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all text-center border border-slate-200">
                    Discard
                </a>
                <button type="submit" id="submitBtn" class="px-8 py-3.5 rounded-xl font-bold text-white transition-all shadow-lg hover:-translate-y-1" style="background-color: var(--navy); box-shadow: 0 10px 15px -3px rgba(10, 31, 44, 0.3);">
                    <i class="fa-solid fa-circle-notch fa-spin hidden mr-2" id="loadIcon"></i>
                    <span id="btnText" style="color: var(--gold-light);"><i class="fa-solid fa-floppy-disk mr-2"></i> Save Registry Record</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const joinInput = document.getElementById('joinDateInput');
    const statusCard = document.getElementById('statusCard');
    const dbStatus = document.getElementById('dbStatusValue');

    joinInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0,0,0,0);
        
        if (selectedDate <= today) {
            statusCard.innerHTML = `
                <div class="px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 font-bold text-xs tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i> COMPLETE JOIN
                </div>
            `;
            statusCard.className = "w-full rounded-xl border-2 border-solid border-emerald-400 bg-emerald-50 p-6 flex flex-col items-center justify-center min-h-[90px] transition-all";
            dbStatus.value = "active";
        } else {
            const diff = Math.ceil(Math.abs(selectedDate - today) / (1000 * 60 * 60 * 24));
            statusCard.innerHTML = `
                <div class="px-4 py-1.5 rounded-full bg-amber-100 text-amber-700 border border-amber-200 font-bold text-xs tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-clock"></i> PENDING JOIN (${diff} Days)
                </div>
            `;
            statusCard.className = "w-full rounded-xl border-2 border-solid border-amber-400 bg-amber-50 p-6 flex flex-col items-center justify-center min-h-[90px] transition-all";
            dbStatus.value = "probation";
        }
    });

    const khmerInput = document.getElementById('khmerInput');
    const khmerCounter = document.getElementById('khmerCounter');
    khmerInput.addEventListener('input', () => {
        const count = khmerInput.value.length;
        khmerCounter.innerText = `${count} / 100 Characters`;
        khmerCounter.style.color = count > 90 ? '#ef4444' : '#94a3b8';
    });

    const phoneInput = document.getElementById('phoneInput');
    phoneInput.addEventListener('input', (e) => {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
    });

    document.getElementById('resetBtn').addEventListener('click', () => {
        Swal.fire({
            title: 'Clear Form Data?', 
            text: "All typed information will be permanently cleared.", 
            icon: 'warning',
            showCancelButton: true, 
            confirmButtonColor: '#ef4444', 
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, clear it',
            borderRadius: '16px'
        }).then((result) => { if (result.isConfirmed) {
            document.getElementById('employeeForm').reset();
            statusCard.innerHTML = '<span class="text-slate-400 text-sm font-medium">Select a start date to calculate...</span>';
            statusCard.className = "w-full rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 flex flex-col items-center justify-center min-h-[90px] transition-all";
            khmerCounter.innerText = "0 / 100 Characters";
            khmerCounter.style.color = '#94a3b8';
        }});
    });

    document.getElementById('employeeForm').addEventListener('submit', function() {
        if (this.checkValidity()) {
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('loadIcon').classList.remove('hidden');
            document.getElementById('btnText').innerText = 'Synchronizing...';
        }
    });
</script>
@endpush