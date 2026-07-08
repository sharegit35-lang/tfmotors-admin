<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | TF Motors</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ink: #1a150e;
            --paper: #f9f7f1;
            --paper-raised: #ffffff;
            --gold: #c59849;
            --gold-deep: #93692b;
            --gold-soft: #f4ecdc;
            --line: #e3d9c6;
            --slate: #5a5245;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        .font-display { font-family: 'Cormorant Garamond', serif; }
        .font-mono { font-family: 'IBM Plex Mono', monospace; }

        [x-cloak] { display: none !important; }

        /* ---------- Header ---------- */
        .site-header {
            border-bottom: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* ---------- Hero ---------- */
        .hero-section {
            background:
                radial-gradient(circle at 10% 0%, rgba(197, 152, 73, 0.08), transparent 50%),
                radial-gradient(circle at 90% 100%, rgba(197, 152, 73, 0.06), transparent 50%),
                var(--paper);
            position: relative;
        }

        .brand-ring {
            width: 72px; height: 72px;
            border: 1.5px solid var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--paper-raised);
            box-shadow: 0 10px 25px -5px rgba(197, 152, 73, 0.2);
        }

        .divider-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--gold);
        }

        /* ---------- Brand showcase row ---------- */
        .brand-frame {
            border: 1px solid var(--line);
            border-radius: 1.5rem;
            background: var(--paper-raised);
            box-shadow: 0 4px 20px -10px rgba(0,0,0,0.05);
        }
        .brand-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .brand-card:hover {
            transform: translateY(-6px);
        }
        .brand-logo-slot {
            height: 40px;
            display: flex;
            align-items: center;
        }
        .brand-photo-slot {
            aspect-ratio: 16 / 10;
            background: linear-gradient(135deg, var(--paper), var(--gold-soft));
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--line);
        }

        /* ---------- Job Cards ---------- */
        .spec-card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .spec-card:hover {
            border-color: var(--gold);
            box-shadow: 0 20px 40px -15px rgba(147, 105, 43, 0.15);
            transform: translateY(-4px);
        }
        .spec-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 4px; height: 100%;
            background: var(--gold);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .spec-card:hover::before { opacity: 1; }
        
        .spec-row {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.75rem 1rem;
            font-size: 0.8rem;
            padding: 1rem;
            background: var(--paper);
            border-radius: 0.75rem;
            border: 1px solid var(--line);
        }
        .spec-label {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate);
        }
        .spec-value {
            font-family: 'IBM Plex Mono', monospace;
            color: var(--ink);
            font-weight: 600;
        }

        /* ---------- HTML Content inside Modal ---------- */
        .quill-content { font-family: 'Inter', sans-serif; color: var(--slate); }
        .quill-content h1, .quill-content h2, .quill-content h3 { font-family: 'Cormorant Garamond', serif; color: var(--ink); font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; }
        .quill-content h1 { font-size: 1.75rem; }
        .quill-content h2 { font-size: 1.5rem; }
        .quill-content p { margin-bottom: 0.75rem; line-height: 1.6; }
        .quill-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .quill-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1rem; }
        .quill-content li { margin-bottom: 0.25rem; }
        .quill-content strong { color: var(--ink); font-weight: 600; }

        /* ---------- Custom Scrollbar ---------- */
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--line); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* ---------- Buttons & Inputs ---------- */
        .btn-gold {
            background: var(--gold);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            background: var(--gold-deep);
            box-shadow: 0 8px 20px -6px rgba(180, 134, 60, 0.4);
        }
        
        .modern-input {
            border: 1px solid var(--line);
            background: var(--paper-raised);
            transition: all 0.3s ease;
        }
        .modern-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(197, 152, 73, 0.15);
        }
    </style>
</head>
<body x-data="{ modalOpen: false, selectedJob: '', selectedDesc: '' }" :class="modalOpen ? 'overflow-hidden' : ''">

    {{-- ============ HEADER ============ --}}
    <header class="site-header">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <svg width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-105 transition-transform">
                    <circle cx="20" cy="20" r="18" stroke="var(--gold)" stroke-width="1.8"/>
                    <text x="20" y="27" text-anchor="middle" font-family="Cormorant Garamond, serif" font-size="22" font-weight="600" fill="var(--gold)">T</text>
                </svg>
                <div class="leading-tight">
                    <p class="font-display font-bold text-xl tracking-[0.05em] text-[var(--ink)]">TF MOTORS</p>
                    <p class="font-mono text-[9px] tracking-[0.2em] uppercase text-[var(--gold)] mt-0.5">Careers</p>
                </div>
            </a>
            <a href="mailto:hello@tfmotors.com" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium text-[var(--slate)] hover:text-[var(--gold)] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                hello@tfmotors.com
            </a>
        </div>
    </header>

    {{-- ============ HERO ============ --}}
    <section class="hero-section py-24 md:py-32">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="brand-ring mx-auto mb-8">
                <span class="font-display font-bold text-4xl text-[var(--gold)]">T</span>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border text-[10px] font-mono tracking-[0.2em] uppercase mb-8 bg-white border-[var(--line)] text-[var(--gold-deep)] shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[var(--gold)] animate-pulse"></span>
                Open Positions: {{ $jobs->count() ?? 0 }}
            </div>
            <h1 class="font-display font-bold text-5xl md:text-7xl leading-[1.1] mb-6 text-[var(--ink)] tracking-tight">
                Join the team behind <br/><span class="text-[var(--gold)] italic">every delivery.</span>
            </h1>
            <p class="text-base md:text-lg leading-relaxed max-w-2xl mx-auto text-[var(--slate)]">
                From the showroom floor to the service bay, TF Motors runs on people who care about the details. Find your next role below.
            </p>
        </div>
    </section>

    {{-- ============ BRANDS ============ --}}
    <section class="max-w-7xl mx-auto px-6 pb-20 -mt-8 relative z-10">
        <div class="brand-frame p-8 md:p-12">
            <div class="flex items-center justify-center gap-4 mb-12">
                <span class="divider-dot"></span>
                <h2 class="font-display font-bold text-3xl tracking-wide text-[var(--ink)]">Brands We Represent</h2>
                <span class="divider-dot"></span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                @php
                    $brands = [
                        ['name' => 'MG', 'blurb' => "Established in 1924, Britain's first automobile brand with a heritage over 100 years."],
                        ['name' => 'MAXUS', 'blurb' => 'Premium and smart vehicles, combining advanced technology, safety, and luxury.'],
                        ['name' => 'ROYAL ENFIELD', 'blurb' => 'The iconic motorcycle brand, bringing classic riding to the modern era.'],
                        ['name' => 'PEUGEOT', 'blurb' => 'Peugeot Motocycles, a French icon since 1898 delivering elegance.'],
                        ['name' => 'LEAPMOTOR', 'blurb' => 'Intelligent EV brand focusing on advanced technology and sustainability.'],
                    ];
                @endphp

                @foreach($brands as $brand)
                <div class="brand-card text-center group">
                    <div class="brand-logo-slot justify-center mb-4">
                        <span class="font-display font-bold text-xl tracking-wide text-[var(--ink)] group-hover:text-[var(--gold)] transition-colors">{{ $brand['name'] }}</span>
                    </div>
                    <div class="brand-photo-slot mb-4 group-hover:border-[var(--gold)] transition-colors">
                        <svg class="w-8 h-8 opacity-20 text-[var(--gold-deep)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 13l1.5-4.5A2 2 0 016.4 7h11.2a2 2 0 011.9 1.5L21 13m-18 0v5a1 1 0 001 1h1a1 1 0 001-1v-1h12v1a1 1 0 001 1h1a1 1 0 001-1v-5m-18 0h18M7 16h.01M17 16h.01"/>
                        </svg>
                    </div>
                    <p class="text-[12px] leading-relaxed text-[var(--slate)]">{{ $brand['blurb'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ JOB LISTINGS ============ --}}
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="flex items-center justify-between mb-10 border-b border-[var(--line)] pb-4">
            <h2 class="font-display font-bold text-4xl text-[var(--ink)]">Open Roles</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
            <div class="spec-card p-8 flex flex-col justify-between group">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <p class="font-mono text-[10px] tracking-[0.2em] uppercase px-3 py-1 bg-[var(--gold-soft)] text-[var(--gold-deep)] rounded-md font-semibold border border-[var(--line)]">
                            {{ $job->employment_type }}
                        </p>
                        @if($job->is_urgent)
                            <span class="flex h-3 w-3 relative">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500" title="Urgent"></span>
                            </span>
                        @endif
                    </div>
                    
                    <h2 class="font-display font-bold text-3xl mb-6 text-[var(--ink)] leading-tight group-hover:text-[var(--gold)] transition-colors">
                        {{ $job->title }}
                    </h2>

                    <div class="spec-row mb-6">
                        <span class="spec-label">Location</span>
                        <span class="spec-value">{{ $job->location }}</span>
                        <span class="spec-label">Salary</span>
                        <span class="spec-value">{{ $job->salary_range ?? 'Competitive' }}</span>
                    </div>

                    {{-- Clean Preview text --}}
                    <p class="text-sm leading-relaxed mb-8 text-[var(--slate)] line-clamp-3">
                        {{ Str::limit(strip_tags($job->description), 120) }}
                    </p>
                </div>

                <button @click="modalOpen = true; selectedJob = {{ Js::from($job->title) }}; selectedDesc = {{ Js::from($job->description) }}"
                        class="w-full py-3.5 rounded-xl font-semibold text-sm tracking-wide border-2 border-[var(--ink)] text-[var(--ink)] hover:bg-[var(--ink)] hover:text-white transition-all flex items-center justify-center gap-2">
                    View Details & Apply
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
            @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-28 rounded-2xl border border-[var(--line)] bg-white border-dashed">
                <span class="font-display font-bold text-3xl text-[var(--gold)] mb-4 block">No open roles currently</span>
                <p class="text-[var(--slate)] max-w-md mx-auto">Our team is fully staffed right now. Please check back later or send your resume to <a href="mailto:hello@tfmotors.com" class="text-[var(--gold-deep)] hover:underline">hello@tfmotors.com</a>.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- ============ APPLICATION MODAL (Detailed & Form) ============ --}}
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" x-cloak>
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-[#1a150e]/60 backdrop-blur-sm"
             @click="modalOpen = false"></div>

        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-400 delay-75" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative w-full max-w-4xl bg-[var(--paper-raised)] rounded-3xl shadow-2xl flex flex-col md:flex-row max-h-[90vh] overflow-hidden border border-[var(--line)]">
            
            <div class="w-full md:w-1/2 bg-[var(--paper)] p-8 md:p-10 overflow-y-auto custom-scrollbar border-r border-[var(--line)]">
                <p class="font-mono text-[10px] tracking-[0.2em] uppercase text-[var(--gold-deep)] mb-3">Role Details</p>
                <h2 class="font-display font-bold text-3xl md:text-4xl text-[var(--ink)] mb-8 leading-tight" x-text="selectedJob"></h2>
                
                {{-- Full HTML Description rendered neatly --}}
                <div class="quill-content text-sm" x-html="selectedDesc"></div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 overflow-y-auto custom-scrollbar bg-white relative">
                <button @click="modalOpen = false" class="absolute top-6 right-6 p-2 rounded-full hover:bg-[var(--paper)] text-[var(--slate)] transition-colors focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <h3 class="font-display font-bold text-2xl text-[var(--ink)] mb-2 mt-4">Submit Application</h3>
                <p class="text-sm text-[var(--slate)] mb-8">Please provide your details below.</p>

                <form id="applyForm" action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="{ fileName: '' }">
                    @csrf
                    <input type="hidden" name="job_title" x-model="selectedJob">
                    
                    <div>
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-2">Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" class="modern-input w-full p-3.5 text-sm rounded-xl" required>
                    </div>
                    
                    <div>
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-2">Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" class="modern-input w-full p-3.5 text-sm rounded-xl" required>
                    </div>

                    <div>
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-2">Resume (PDF)</label>
                        <label class="flex flex-col items-center justify-center w-full p-6 rounded-xl border border-dashed border-[var(--gold)] bg-[var(--gold-soft)] hover:bg-[var(--paper)] cursor-pointer transition-colors group">
                            <svg class="w-6 h-6 text-[var(--gold-deep)] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            <span class="text-sm font-semibold text-[var(--ink)] text-center px-4" x-text="fileName ? fileName : 'Upload Resume'"></span>
                            <span class="text-[11px] text-[var(--slate)] mt-1" x-show="!fileName">PDF up to 5MB</span>
                            <input type="file" name="resume" class="hidden" required accept=".pdf" @change="fileName = $event.target.files[0].name">
                        </label>
                    </div>

                    <button type="submit" class="btn-gold w-full mt-4 py-4 rounded-xl font-bold text-sm tracking-wide flex items-center justify-center gap-2">
                        Send Application
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let applyForm = document.getElementById('applyForm');
            if(applyForm) {
                applyForm.addEventListener('submit', function() {
                    Swal.fire({
                        title: 'កំពុងបញ្ជូន...',
                        html: '<p style="color:var(--slate);font-size:14px;">សូមរង់ចាំបន្តិច ប្រព័ន្ធកំពុងដំណើរការ។</p>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: 'var(--paper-raised)',
                        color: 'var(--ink)',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });
            }

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'ជោគជ័យ!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: 'var(--gold)',
                    background: 'var(--paper-raised)',
                    color: 'var(--ink)',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg px-6 font-bold' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'បរាជ័យ!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ef4444',
                    background: 'var(--paper-raised)',
                    color: 'var(--ink)',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg px-6 font-bold' }
                });
            @endif
        });
    </script>
</body>
</html>