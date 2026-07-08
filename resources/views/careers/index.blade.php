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
            --ink: #201a12;
            --paper: #fdfbf7;
            --paper-raised: #ffffff;
            --gold: #b4863c;
            --gold-deep: #93692b;
            --gold-soft: #f3e6cd;
            --line: #e8e0d0;
            --slate: #6b6355;
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* ---------- Hero ---------- */
        .hero-section {
            background:
                radial-gradient(circle at 12% 15%, rgba(180, 134, 60, 0.07), transparent 45%),
                radial-gradient(circle at 88% 20%, rgba(180, 134, 60, 0.06), transparent 45%),
                var(--paper);
            position: relative;
        }

        .brand-ring {
            width: 84px; height: 84px;
            border: 2px solid var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px -10px rgba(180, 134, 60, 0.3);
        }

        .divider-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold);
        }

        /* ---------- Brand showcase row ---------- */
        .brand-frame {
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            background: var(--paper-raised);
        }
        .brand-card {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }
        .brand-card:hover {
            transform: translateY(-4px);
        }
        .brand-logo-slot {
            height: 44px;
            display: flex;
            align-items: center;
        }
        .brand-photo-slot {
            aspect-ratio: 16 / 10;
            background: linear-gradient(135deg, var(--gold-soft), #eee3cb);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--line);
        }

        /* ---------- Job Card ---------- */
        .spec-card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .spec-card:hover {
            border-color: var(--gold);
            box-shadow: 0 20px 40px -20px rgba(32, 26, 18, 0.18);
            transform: translateY(-4px);
        }
        .spec-row {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.5rem 0.75rem;
            font-size: 0.78rem;
        }
        .spec-label {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--slate);
        }
        .spec-value {
            font-family: 'IBM Plex Mono', monospace;
            color: var(--ink);
            font-weight: 600;
        }

        /* ---------- Buttons ---------- */
        .btn-shine {
            position: relative;
            overflow: hidden;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: 0; left: -120%;
            width: 100%; height: 100%;
            background: linear-gradient(100deg, transparent, rgba(255,255,255,0.35), transparent);
            transition: left 0.55s ease;
        }
        .btn-shine:hover::after { left: 120%; }
        .btn-shine:active { transform: scale(0.97); }
        .btn-shine:hover { transform: translateY(-1px); box-shadow: 0 10px 20px -8px rgba(180, 134, 60, 0.4); }

        .focus-ring:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(180, 134, 60, 0.18);
        }

        /* ---------- Custom Quill Content (For Modal HTML) ---------- */
        .quill-content { font-family: 'Inter', sans-serif; color: var(--slate); }
        .quill-content h1, .quill-content h2, .quill-content h3 { font-family: 'Cormorant Garamond', serif; color: var(--ink); font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.5rem; line-height: 1.2;}
        .quill-content h1 { font-size: 1.75rem; }
        .quill-content h2 { font-size: 1.25rem; }
        .quill-content p { margin-bottom: 0.75rem; line-height: 1.7; }
        .quill-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; line-height: 1.7; }
        .quill-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1rem; line-height: 1.7; }
        .quill-content li { margin-bottom: 0.35rem; }
        .quill-content strong, .quill-content b { font-weight: 600; color: var(--ink); }

        /* ---------- Custom Scrollbar ---------- */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--line); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* ---------- Contact footer ---------- */
        .site-footer {
            background: linear-gradient(155deg, #201a12 0%, #2a2115 100%);
            position: relative;
            overflow: hidden;
        }
        .site-footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .contact-card { display: flex; gap: 1rem; align-items: flex-start; transition: transform 0.25s ease; }
        .contact-card:hover { transform: translateY(-2px); }
        .contact-icon {
            width: 42px; height: 42px; border-radius: 0.65rem;
            background: rgba(180, 134, 60, 0.14); border: 1px solid rgba(180, 134, 60, 0.3);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .contact-icon svg { width: 20px; height: 20px; color: var(--gold); }
        .contact-label { font-family: 'IBM Plex Mono', monospace; font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase; color: #8f8878; margin-bottom: 0.35rem; }
        .contact-value { color: #f3efe6; font-size: 0.92rem; font-weight: 500; line-height: 1.5; }
        .contact-value a { color: #f3efe6; transition: color 0.2s ease; }
        .contact-value a:hover { color: var(--gold); }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); }

    </style>
</head>
<body x-data="{ modalOpen: false, selectedJob: '', selectedDesc: '' }" :class="modalOpen ? 'overflow-hidden' : ''">

    {{-- ============ HEADER ============ --}}
    <header class="site-header">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="18" stroke="#B4863C" stroke-width="1.6"/>
                    <text x="20" y="27" text-anchor="middle" font-family="Cormorant Garamond, serif" font-size="20" font-weight="600" fill="#B4863C">T</text>
                </svg>
                <div class="leading-tight">
                    <p class="font-display font-bold text-xl tracking-[0.08em]" style="color: var(--ink);">TF MOTORS</p>
                    <p class="font-mono text-[10px] tracking-[0.25em] uppercase mt-0.5" style="color: var(--gold);">Careers</p>
                </div>
            </a>
            <a href="mailto:hello@tfmotors.com" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium hover:text-[var(--gold)] transition-colors" style="color: var(--slate);">
                hello@tfmotors.com
            </a>
        </div>
    </header>

    {{-- ============ HERO ============ --}}
    <section class="hero-section py-20 md:py-28">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="brand-ring mx-auto mb-6">
                <span class="font-display font-semibold text-3xl" style="color: var(--gold);">T</span>
            </div>
            <p class="font-mono text-xs tracking-[0.25em] uppercase mb-6" style="color: var(--gold-deep);">
                Open Positions — {{ $jobs->count() ?? 0 }}
            </p>
            <h1 class="font-display font-semibold text-4xl md:text-6xl leading-[1.15] mb-6" style="color: var(--ink);">
                Join the team behind <span class="italic text-[var(--gold)]">every delivery.</span>
            </h1>
            <p class="text-base md:text-lg leading-relaxed max-w-2xl mx-auto" style="color: var(--slate);">
                From the showroom floor to the service bay, TF Motors runs on people who care about the details. Find your next role below.
            </p>
        </div>
    </section>

    {{-- ============ BRANDS ============ --}}
    <section class="max-w-6xl mx-auto px-6 pb-16">
        <div class="brand-frame p-8 md:p-10">
            <div class="flex items-center justify-center gap-3 mb-10">
                <span class="divider-dot"></span>
                <h2 class="font-display font-semibold text-2xl tracking-wide" style="color: var(--gold-deep);">TF MOTORS (Cambodia)</h2>
                <span class="divider-dot"></span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @php
                    $brands = [
                        ['name' => 'MG', 'blurb' => "Established in 1924, Britain's first automobile brand with a long heritage."],
                        ['name' => 'MAXUS', 'blurb' => 'Premium and smart vehicles, combining advanced technology and safety.'],
                        ['name' => 'ROYAL ENFIELD', 'blurb' => 'Royal Enfield is an iconic motorcycle brand with classic riding.'],
                        ['name' => 'PEUGEOT', 'blurb' => 'Peugeot Motocycles, a French icon since 1898 delivering elegance.'],
                        ['name' => 'LEAPMOTOR', 'blurb' => 'Intelligent EV brand focusing on advanced technology and sustainability.'],
                    ];
                @endphp

                @foreach($brands as $brand)
                <div class="brand-card text-center group">
                    <div class="brand-logo-slot justify-center mb-3">
                        <span class="font-display font-bold text-lg tracking-wide group-hover:text-[var(--gold)] transition-colors" style="color: var(--ink);">{{ $brand['name'] }}</span>
                    </div>
                    <div class="brand-photo-slot mb-3 group-hover:border-[var(--gold)] transition-colors">
                        <svg class="w-8 h-8 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-deep);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 13l1.5-4.5A2 2 0 016.4 7h11.2a2 2 0 011.9 1.5L21 13m-18 0v5a1 1 0 001 1h1a1 1 0 001-1v-1h12v1a1 1 0 001 1h1a1 1 0 001-1v-5m-18 0h18M7 16h.01M17 16h.01"/>
                        </svg>
                    </div>
                    <p class="text-[11px] leading-relaxed" style="color: var(--slate);">{{ $brand['blurb'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ JOB LISTINGS ============ --}}
    <section class="max-w-6xl mx-auto px-6 pb-20">
        <div class="flex items-center justify-center gap-3 mb-10">
            <span class="divider-dot"></span>
            <h2 class="font-display font-semibold text-3xl tracking-wide" style="color: var(--gold-deep);">Open Roles</h2>
            <span class="divider-dot"></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($jobs as $job)
            <div class="spec-card p-8 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <p class="font-mono text-[11px] tracking-[0.2em] uppercase px-2 py-1 rounded bg-[var(--gold-soft)]" style="color: var(--gold-deep);">
                            {{ strtoupper($job->employment_type) }}
                        </p>
                        @if($job->is_urgent)
                            <span class="flex h-2.5 w-2.5 relative">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                        @endif
                    </div>
                    
                    <h2 class="font-display font-semibold text-3xl mb-5" style="color: var(--ink);">
                        {{ $job->title }}
                    </h2>

                    <div class="spec-row mb-5">
                        <span class="spec-label">Location</span>
                        <span class="spec-value">{{ $job->location }}</span>
                        <span class="spec-label">Salary</span>
                        <span class="spec-value">{{ $job->salary_range ?? 'COMPETITIVE' }}</span>
                    </div>

                    {{-- ⚡️ ប្រើ strip_tags ដើម្បីបង្ហាញអត្ថបទស្អាត --}}
                    <p class="text-sm leading-relaxed mb-6" style="color: var(--slate);">
                        {{ Str::limit(strip_tags($job->description), 120) }}
                    </p>
                </div>

                <button @click="modalOpen = true; selectedJob = {{ Js::from($job->title) }}; selectedDesc = {{ Js::from($job->description) }}"
                        class="btn-shine mt-4 w-full py-3.5 rounded-lg text-sm font-semibold tracking-wide text-white flex items-center justify-center gap-2"
                        style="background: var(--ink);">
                    View & Apply
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
            @empty
            <div class="md:col-span-2 text-center py-24 rounded-2xl border border-dashed border-[var(--gold)] bg-[var(--paper-raised)]">
                <p class="font-display font-semibold text-2xl mb-3" style="color: var(--ink);">No open roles right now.</p>
                <p class="text-sm" style="color: var(--slate);">Check back soon, or send your resume directly to <a href="mailto:hello@tfmotors.com" class="text-[var(--gold-deep)] hover:underline">hello@tfmotors.com</a>.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- ============ CONTACT FOOTER ============ --}}
    <footer class="site-footer">
        <div class="max-w-6xl mx-auto px-6 py-16 relative">
            <div class="flex items-center gap-3 mb-10">
                <span class="w-1.5 h-1.5 rounded-full" style="background: var(--gold);"></span>
                <p class="font-mono text-xs tracking-[0.25em] uppercase" style="color: var(--gold);">Get In Touch</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Phone --}}
                <div class="contact-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="contact-label">Phone</p>
                        <p class="contact-value">
                            <a href="tel:+85510911193">010 911 193</a><br>
                            <a href="tel:+85510911193">+855 10 911 193</a>
                        </p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="contact-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="contact-label">Email</p>
                        <p class="contact-value">
                            <a href="mailto:careers@tfmotors.com.kh">careers@tfmotors.com.kh</a>
                        </p>
                    </div>
                </div>

                {{-- Address --}}
                <div class="contact-card">
                    <div class="contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="contact-label">Address</p>
                        <p class="contact-value">
                            No. 174-175, California Social House, Russian Federation Blvd,<br>
                            Sangkat Teuk Thla, Khan Sen Sok, Phnom Penh
                        </p>
                    </div>
                </div>
            </div>

            <div class="footer-divider mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs" style="color: #8f8878;">&copy; {{ date('Y') }} TF Motors Cambodia. All rights reserved.</p>
                <p class="font-mono text-[10px] tracking-[0.2em] uppercase" style="color: #8f8878;">MG &middot; Maxus &middot; Royal Enfield &middot; Peugeot &middot; Leapmotor</p>
            </div>
        </div>
    </footer>

    {{-- ============ APPLICATION MODAL (SPLIT DESIGN) ============ --}}
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" x-cloak>
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-[#201a12]/70 backdrop-blur-sm"
             @click="modalOpen = false"></div>

        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-400 delay-75" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative w-full max-w-5xl bg-[var(--paper-raised)] rounded-2xl shadow-2xl flex flex-col md:flex-row max-h-[90vh] overflow-hidden" style="border-top: 4px solid var(--gold);">
            
            <div class="w-full md:w-1/2 p-8 md:p-10 overflow-y-auto custom-scrollbar border-b md:border-b-0 md:border-r border-[var(--line)] bg-[var(--paper)]">
                <p class="font-mono text-[11px] tracking-[0.2em] uppercase mb-3 text-[var(--gold-deep)]">Role Details</p>
                <h2 class="font-display font-semibold text-3xl md:text-4xl text-[var(--ink)] mb-6 leading-tight" x-text="selectedJob"></h2>
                
                {{-- ⚡️ Render Real HTML HTML from Quill --}}
                <div class="quill-content" x-html="selectedDesc"></div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 overflow-y-auto custom-scrollbar relative bg-[var(--paper-raised)]">
                <button @click="modalOpen = false" class="absolute top-5 right-5 p-2 rounded-full hover:bg-[var(--line)] text-[var(--slate)] transition-colors focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <h3 class="font-display font-semibold text-2xl text-[var(--ink)] mb-2 mt-2">Submit Application</h3>
                <p class="text-sm text-[var(--slate)] mb-8">Please provide your details below.</p>

                <form id="applyForm" action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ fileName: '' }">
                    @csrf
                    <input type="hidden" name="job_title" x-model="selectedJob">
                    
                    <div>
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-1.5">Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" class="focus-ring w-full p-3.5 text-sm rounded-lg" style="border: 1px solid var(--line); background: var(--paper);" required>
                    </div>
                    
                    <div>
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-1.5">Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" class="focus-ring w-full p-3.5 text-sm rounded-lg" style="border: 1px solid var(--line); background: var(--paper);" required>
                    </div>

                    <div class="pt-2">
                        <label class="block font-mono text-[10px] tracking-[0.1em] uppercase text-[var(--slate)] mb-1.5">Resume (PDF)</label>
                        <label class="flex flex-col items-center justify-center w-full p-6 rounded-lg border border-dashed hover:bg-[var(--paper)] cursor-pointer transition-colors group" style="border-color: var(--gold); background: var(--gold-soft);">
                            <svg class="w-6 h-6 text-[var(--gold-deep)] mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            <span class="text-sm font-semibold text-[var(--ink)] text-center px-4" x-text="fileName ? fileName : 'Upload Resume'"></span>
                            <span class="text-[11px] text-[var(--slate)] mt-1 font-mono" x-show="!fileName">MAX 5MB</span>
                            <input type="file" name="resume" class="hidden" required accept=".pdf" @change="fileName = $event.target.files[0].name">
                        </label>
                    </div>

                    <button type="submit" class="btn-shine w-full mt-6 py-4 rounded-lg font-semibold text-sm tracking-wide text-white flex items-center justify-center gap-2" style="background: var(--ink);">
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
                        html: '<p style="color:var(--slate);font-size:14px;font-family:Inter,sans-serif;">សូមរង់ចាំបន្តិច ប្រព័ន្ធកំពុងដំណើរការ។</p>',
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
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg px-6 font-bold font-mono' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'បរាជ័យ!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#e74c3c',
                    background: 'var(--paper-raised)',
                    color: 'var(--ink)',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-lg px-6 font-bold font-mono' }
                });
            @endif
        });
    </script>
</body>
</html>