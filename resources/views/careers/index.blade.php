<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | TF Motors</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand-dark: #0a101d;
            --brand-blue: #2563eb;
            --brand-blue-hover: #1d4ed8;
            --surface-bg: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--surface-bg);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        .font-display { font-family: 'Space Grotesk', sans-serif; }

        [x-cloak] { display: none !important; }

        /* ---------- Custom Advanced Animations ---------- */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes revealLine {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }

        /* ---------- Hero Section ---------- */
        .hero-section {
            background: radial-gradient(circle at top right, #1e293b 0%, var(--brand-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-glow {
            position: absolute;
            top: -20%;
            right: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ---------- Job Cards ---------- */
        .job-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: var(--brand-blue);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .job-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.1);
            border-color: transparent;
        }

        .job-card:hover::before {
            transform: scaleX(1);
        }

        /* ---------- Form Inputs & Buttons ---------- */
        .modern-input {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .modern-input:focus {
            background: #ffffff;
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .btn-primary {
            background: var(--brand-dark);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background: var(--brand-blue);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(37, 99, 235, 0.5);
        }

        /* Custom Scrollbar for Modal */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body x-data="{ modalOpen: false, selectedJob: '', selectedDesc: '' }" :class="modalOpen ? 'overflow-hidden' : ''">

    {{-- ============ HEADER ============ --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center transition-transform group-hover:scale-105">
                    <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 27L14.5 13H18L21 22.5L24 13H27.5L33 27H29.2L26 18L23 27H19.8L17 18L14 27H9Z" fill="#F6F7F9"/>
                        <rect x="9" y="29.5" width="22" height="2" rx="1" fill="#2563EB"/>
                    </svg>
                </div>
                <div>
                    <p class="font-display font-bold text-lg leading-none tracking-tight text-slate-900">TF MOTORS</p>
                    <p class="text-[10px] tracking-[0.2em] uppercase font-bold text-blue-600 mt-1">Careers</p>
                </div>
            </a>
            <a href="mailto:hello@tfmotors.com" class="hidden sm:flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                hello@tfmotors.com
            </a>
        </div>
    </header>

    {{-- ============ HERO ============ --}}
    <section class="hero-section text-white py-24 md:py-32">
        <div class="hero-glow"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-3xl animate-fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-bold tracking-widest uppercase mb-6 text-blue-300">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Open Positions: {{ $jobs->count() ?? 0 }}
                </div>
                <h1 class="font-display font-bold text-5xl md:text-7xl leading-[1.1] tracking-tight mb-6">
                    Join the team behind <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-200">every delivery.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-400 leading-relaxed max-w-2xl font-medium">
                    From the showroom floor to the service bay, TF Motors runs on people who care about the details. Find your next role below.
                </p>
            </div>
        </div>
    </section>

    {{-- ============ JOB LISTINGS ============ --}}
    <section class="max-w-7xl mx-auto px-6 py-20 -mt-10 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $index => $job)
                <div class="job-card p-8 flex flex-col justify-between animate-fade-up" style="animation-delay: {{ $index * 100 }}ms;">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider rounded-md">
                                {{ $job->employment_type }}
                            </span>
                        </div>
                        
                        <h2 class="font-display font-bold text-2xl text-slate-900 mb-4 leading-tight">
                            {{ $job->title }}
                        </h2>

                        <div class="space-y-2 mb-6">
                            <div class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $job->location }}
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->salary_range ?? 'Competitive Salary' }}
                            </div>
                        </div>

                        <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-8">
                            {{ Str::limit($job->description, 130) }}
                        </p>
                    </div>

                    <button @click="modalOpen = true; selectedJob = {{ Js::from($job->title) }}; selectedDesc = {{ Js::from($job->description) }}"
                            class="w-full py-3.5 px-4 bg-slate-900 text-white text-sm font-bold rounded-xl transition-all hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/30 flex items-center justify-center gap-2 group">
                        Apply Now
                        <svg class="w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 text-center py-24 bg-white rounded-3xl border border-slate-200 border-dashed animate-fade-up">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-slate-900 mb-2">No open roles right now</h3>
                    <p class="text-slate-500 max-w-sm mx-auto">Check back soon, or send your resume directly to our team at hello@tfmotors.com.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- ============ APPLICATION MODAL ============ --}}
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" x-cloak>
        <!-- Backdrop -->
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
             @click="modalOpen = false"></div>

        <!-- Modal Panel -->
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300 delay-100" 
             x-transition:enter-start="opacity-0 translate-y-8 scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-slate-100 flex items-start justify-between bg-slate-50/50">
                <div>
                    <p class="text-[10px] tracking-[0.2em] uppercase font-bold text-blue-600 mb-2">Application Form</p>
                    <h2 class="font-display font-bold text-2xl text-slate-900 leading-tight" x-text="selectedJob"></h2>
                </div>
                <button @click="modalOpen = false" class="p-2 bg-white border border-slate-200 text-slate-400 rounded-full hover:bg-slate-100 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-8 overflow-y-auto custom-scrollbar">
                
                <div class="mb-8 p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Role Description
                    </h3>
                    <p x-text="selectedDesc" class="text-sm text-slate-600 leading-relaxed whitespace-pre-wrap"></p>
                </div>

                <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="job_title" x-model="selectedJob">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Full Name</label>
                            <input type="text" name="name" placeholder="John Doe" class="modern-input w-full p-3.5 text-sm rounded-xl" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Email Address</label>
                            <input type="email" name="email" placeholder="john@example.com" class="modern-input w-full p-3.5 text-sm rounded-xl" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Resume (PDF)</label>
                        <label class="flex flex-col items-center justify-center w-full p-6 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-blue-50 hover:border-blue-300 cursor-pointer transition-colors group">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors">Click to upload your resume</span>
                            <span class="text-xs text-slate-500 mt-1">Maximum file size: 5MB</span>
                            <input type="file" name="resume" class="hidden" required accept=".pdf">
                        </label>
                    </div>

                    <div class="pt-4 mt-6 border-t border-slate-100 flex gap-3">
                        <button type="button" @click="modalOpen = false" class="px-6 py-3.5 rounded-xl font-bold text-sm text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors flex-1 sm:flex-none text-center">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary px-8 py-3.5 rounded-xl font-bold text-sm text-white flex-1 flex items-center justify-center gap-2">
                            Submit Application
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>