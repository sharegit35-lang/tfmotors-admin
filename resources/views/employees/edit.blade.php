@extends('layouts.admin')

@section('title', 'Edit Employee | TF Admin')
@section('header_title', 'កែប្រែព័ត៌មានបុគ្គលិក')

@section('content')

<style>
    :root {
        --navy-deep: #0a1f2c;
        --navy: #0f2b3d;
        --navy-light: #123447;
        --gold: #d4af37;
        --gold-light: #f3d980;
    }

    @keyframes editFadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .edit-animate { opacity: 0; animation: editFadeUp .5s ease forwards; }
    .edit-delay-1 { animation-delay: .05s; }
    .edit-delay-2 { animation-delay: .12s; }
    .edit-delay-3 { animation-delay: .19s; }
    .edit-delay-4 { animation-delay: .26s; }

    .icon { display: inline-block; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }

    /* ---- Consolidated field styles ---- */
    .f-label { display: block; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .f-label.f-label--accent { color: var(--gold); }

    .f-input {
        width: 100%; border-radius: 0.75rem; border: 1px solid #e2e8f0; background: #f8fafc;
        padding: 0.875rem 1rem; font-size: 0.875rem; color: #1e293b; transition: border-color .2s, box-shadow .2s, background-color .2s;
    }
    .f-input:focus { outline: none; border-color: var(--gold); box-shadow: 0 0 0 3px rgba(212,175,55,0.22); background: #fff; }
    .f-input--upper { text-transform: uppercase; }
    .f-input--highlight { border-color: rgba(212,175,55,0.45); background: rgba(212,175,55,0.07); }
    .f-input--highlight:focus { background: #fff; }
    .f-input--strong { font-size: 1.05rem; font-weight: 700; color: var(--navy); }

    .f-col-2 { grid-column: span 2 / span 2; }

    /* ---- Section header ---- */
    .section-head {
        display: flex; align-items: center; gap: 0.6rem;
        border-bottom: 2px solid #f1f5f9; padding-bottom: 0.85rem; margin-bottom: 1.5rem;
    }
    .section-num {
        width: 24px; height: 24px; border-radius: 999px; flex-shrink: 0;
        background: var(--navy); color: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700;
    }
    .section-title { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--navy); }

    /* ---- Status insight card ---- */
    .status-pill {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.4rem 1rem; border-radius: 999px; font-size: 11px; font-weight: 700; letter-spacing: 0.06em;
    }
    .status-card {
        width: 100%; border-radius: 0.75rem; border: 2px dashed #e2e8f0; background: #f8fafc;
        padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center;
        min-height: 90px; transition: all .25s ease;
    }
    .status-card--joined { border-style: solid; border-color: #6ee7b7; background: #ecfdf5; }
    .status-card--pending { border-style: solid; border-color: var(--gold); background: rgba(212,175,55,0.08); }

    /* ---- Submit button ---- */
    .btn-sync {
        background: linear-gradient(135deg, var(--navy), var(--navy-light));
        box-shadow: 0 10px 24px -8px rgba(15,43,61,0.45);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-sync:hover { transform: translateY(-2px); box-shadow: 0 14px 28px -8px rgba(15,43,61,0.5); }
    .btn-sync:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .spin { animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    @media (prefers-reduced-motion: reduce) {
        .edit-animate { animation: none; opacity: 1; }
        .btn-sync { transition: none; }
        .spin { animation: none; }
    }
</style>

<div class="w-full">

    {{-- Hero --}}
    <div class="edit-animate relative overflow-hidden rounded-3xl p-6 md:p-10 text-white shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center gap-6"
         style="background: linear-gradient(135deg, var(--navy-deep), var(--navy) 55%, var(--navy-light));">

        <div class="absolute -right-10 -top-10 w-52 h-52 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,0.18), transparent 70%);"></div>
        <div class="absolute right-24 -bottom-10 w-40 h-40 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,0.12), transparent 70%);"></div>

        <div class="relative flex items-center gap-4 text-center md:text-left">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center shrink-0 hidden sm:flex"
                 style="background: rgba(212,175,55,0.15); border: 1px solid rgba(212,175,55,0.35);">
                <svg class="icon" style="width: 24px; height: 24px; color: var(--gold);" viewBox="0 0 24 24">
                    <path d="M4 20l1-4.2L15.6 5.2a1.5 1.5 0 0 1 2.1 0l1.1 1.1a1.5 1.5 0 0 1 0 2.1L8.2 19l-4.2 1z"/>
                    <path d="M14.2 6.8l3 3"/>
                </svg>
            </div>
            <div>
                <p class="text-xs tracking-[0.2em] uppercase mb-1" style="color: rgba(243,236,217,0.55);">Employee Record</p>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">UPDATE PERSONNEL</h1>
                <p class="mt-1 text-sm" style="color: rgba(243,236,217,0.75);">
                    Managing record for: <strong class="text-white">{{ $employee->english_name }}</strong>
                </p>
            </div>
        </div>

        <div class="relative bg-white/10 backdrop-blur-md text-white px-5 py-2.5 rounded-full text-sm font-bold border border-white/15 shadow-inner whitespace-nowrap">
            UID: #{{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}
        </div>
    </div>

    {{-- Form card --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-10 w-full">
        
        {{-- FIX: Added id="editEmployeeForm" back so the JS at the bottom works --}}
        <form id="editEmployeeForm" action="{{ route('admin.employees.update', bin2hex(\Illuminate\Support\Facades\Crypt::encryptString($employee->id))) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- I. Identity Profile --}}
            <div class="edit-animate edit-delay-1 mb-10">
                <div class="section-head">
                    <span class="section-num">I</span>
                    <span class="section-title">Identity Profile</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="f-label">Full Name (English)</label>
                        <input type="text" name="english_name" value="{{ old('english_name', $employee->english_name) }}" class="f-input f-input--upper" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">Full Name (Khmer)</label>
                        <input type="text" name="khmer_name" id="khmerInput" value="{{ old('khmer_name', $employee->khmer_name) }}" maxlength="100" class="f-input" required>
                        <div class="text-right text-[10px] font-bold text-slate-400 mt-1.5" id="khmerCounter">0 / 100 Characters</div>
                    </div>
                    <div>
                        <label class="f-label">Gender</label>
                        <select name="gender" class="f-input" required>
                            <option value="male" {{ (old('gender', strtolower($employee->gender)) == 'male') ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ (old('gender', strtolower($employee->gender)) == 'female') ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="f-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}" class="f-input" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">Contact Number</label>
                        <input type="tel" name="phone" id="phoneInput" value="{{ old('phone', $employee->phone) }}" class="f-input" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                </div>
            </div>

            {{-- II. Legal Documents --}}
            <div class="edit-animate edit-delay-2 mb-10">
                <div class="section-head">
                    <span class="section-num">II</span>
                    <span class="section-title">Legal Documents</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="f-label">National ID Number</label>
                        <input type="text" name="identity_card" value="{{ old('identity_card', $employee->identity_card) }}" class="f-input" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">Passport (Optional)</label>
                        <input type="text" name="cambodian_passport" value="{{ old('cambodian_passport', $employee->cambodian_passport) }}" class="f-input">
                    </div>
                </div>
            </div>

            {{-- III. Deployment & Status --}}
            <div class="edit-animate edit-delay-3 mb-10">
                <div class="section-head">
                    <span class="section-num">III</span>
                    <span class="section-title">Deployment &amp; Status</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-2">
                        <label class="f-label">Position</label>
                        <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="f-input" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">Department</label>
                        <input type="text" name="department_name" value="{{ old('department_name', $employee->department_name) }}" class="f-input" required>
                    </div>
                    <div>
                        <label class="f-label">Corporate Branch</label>
                        <select name="branch_name" class="f-input" required>
                            <option value="Headquarters" {{ old('branch_name', $employee->branch_name) == 'Headquarters' ? 'selected' : '' }}>Headquarters (Phnom Penh)</option>
                            <option value="Siem Reap" {{ old('branch_name', $employee->branch_name) == 'Siem Reap' ? 'selected' : '' }}>Siem Reap Branch</option>
                            <option value="Battambang" {{ old('branch_name', $employee->branch_name) == 'Battambang' ? 'selected' : '' }}>Battambang Branch</option>
                            <option value="MH" {{ old('branch_name', $employee->branch_name) == 'MH' ? 'selected' : '' }}>MH Service Center</option>
                            <option value="Vive Motors" {{ old('branch_name', $employee->branch_name) == 'Vive Motors' ? 'selected' : '' }}>Vive Motors</option>
                        </select>
                    </div>
                    <div>
                        <label class="f-label">Category Group</label>
                        <select name="branch_code" class="f-input" required>
                            <option value="2W" {{ old('branch_code', $employee->branch_code) == '2W' ? 'selected' : '' }}>Automotive (2W)</option>
                            <option value="4W" {{ old('branch_code', $employee->branch_code) == '4W' ? 'selected' : '' }}>Automotive (4W)</option>
                            <option value="Support" {{ old('branch_code', $employee->branch_code) == 'Support' ? 'selected' : '' }}>Corporate Support</option>
                        </select>
                    </div>
                    <div>
                        <label class="f-label f-label--accent">Effective Start Date</label>
                        <input type="date" name="start_work" id="joinDateInput" value="{{ old('start_work', $employee->start_work) }}" class="f-input f-input--highlight" required>
                    </div>
                    <div>
                        <label class="f-label">Manual Status Override</label>
                        <select name="status" id="manualStatusSelect" class="f-input" style="font-weight: 700; background-color: #f1f5f9;">
                            <option value="active" {{ old('status', strtolower($employee->status)) == 'active' ? 'selected' : '' }}>ACTIVE / JOINED</option>
                            <option value="probation" {{ old('status', strtolower($employee->status)) == 'probation' ? 'selected' : '' }}>PROBATION / PENDING</option>
                            <option value="can't join" {{ old('status', strtolower($employee->status)) == "can't join" ? 'selected' : '' }}>CANCELLED</option>
                            <option value="resigned" {{ old('status', strtolower($employee->status)) == 'resigned' ? 'selected' : '' }}>RESIGNED</option>
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">Gross Salary (USD)</label>
                        <input type="number" step="0.01" name="salary" value="{{ old('salary', $employee->salary) }}" class="f-input f-input--strong" required>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="f-label">System Status Insight</label>
                        <div id="statusCard" class="status-card"></div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="edit-animate edit-delay-4 flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t border-slate-100">
                <a href="{{ route('admin.employees.index') }}" class="px-8 py-3.5 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all text-center">
                    Discard
                </a>
                <button type="submit" id="submitBtn" class="btn-sync px-8 py-3.5 rounded-xl font-bold text-white text-center">
                    <span class="inline-flex items-center justify-center gap-2" id="btnText">
                        <svg class="icon" style="width: 16px; height: 16px;" viewBox="0 0 24 24">
                            <path d="M7 16a4 4 0 0 1-.4-7.98A5.5 5.5 0 0 1 17.4 7.1 4.5 4.5 0 0 1 17 16H7z"/>
                            <path d="M12 12v6M9.5 15.5L12 18l2.5-2.5"/>
                        </svg>
                        SYNC TO DATABASE
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const joinInput = document.getElementById('joinDateInput');
    const statusCard = document.getElementById('statusCard');
    const manualStatus = document.getElementById('manualStatusSelect');
    const khmerInput = document.getElementById('khmerInput');
    const khmerCounter = document.getElementById('khmerCounter');

    khmerInput.addEventListener('input', () => {
        const count = khmerInput.value.length;
        khmerCounter.innerText = `${count} / 100 Characters`;
        khmerCounter.style.color = count > 90 ? '#ef4444' : '#94a3b8';
    });

    const iconCheck = `<svg class="icon" style="width:14px;height:14px;" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 5-5"/></svg>`;
    const iconClock = `<svg class="icon" style="width:14px;height:14px;" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>`;

    function syncStatusLogic() {
        if (!joinInput.value) return;
        const selectedDate = new Date(joinInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate <= today) {
            statusCard.innerHTML = `
                <div class="status-pill" style="background:#d1fae5; color:#047857; border:1px solid #6ee7b7;">
                    ${iconCheck} DATE PASSED
                </div>
            `;
            statusCard.className = 'status-card status-card--joined';
            if (manualStatus.value === 'probation') manualStatus.value = 'active';
        } else {
            const diff = Math.ceil(Math.abs(selectedDate - today) / (1000 * 60 * 60 * 24));
            statusCard.innerHTML = `
                <div class="status-pill" style="background:rgba(212,175,55,0.15); color:#8a6d1f; border:1px solid rgba(212,175,55,0.4);">
                    ${iconClock} PENDING (${diff} Days)
                </div>
            `;
            statusCard.className = 'status-card status-card--pending';
        }
    }

    joinInput.addEventListener('change', syncStatusLogic);
    window.addEventListener('load', () => {
        syncStatusLogic();
        khmerCounter.innerText = `${khmerInput.value.length} / 100 Characters`;
    });

    document.getElementById('editEmployeeForm').addEventListener('submit', function () {
        if (this.checkValidity()) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            document.getElementById('btnText').innerHTML = `
                <svg class="icon spin" style="width:16px;height:16px;" viewBox="0 0 24 24">
                    <path d="M21 12a9 9 0 1 1-3.5-7.1"/>
                </svg>
                Syncing...
            `;
        }
    });
</script>
@endpush