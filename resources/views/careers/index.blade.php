<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | TF Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0d1b2a;
            --ink-soft: #1b2e42;
            --paper: #f6f7f9;
            --paper-raised: #ffffff;
            --blue: #1859e0;
            --blue-deep: #123f9e;
            --line: #e2e5ea;
            --slate: #5b6672;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            color: var(--ink);
        }

        .font-display { font-family: 'Manrope', sans-serif; }
        .font-mono { font-family: 'IBM Plex Mono', monospace; }

        [x-cloak] { display: none !important; }

        /* ---------- Header ---------- */
        .site-header {
            border-bottom: 1px solid var(--line);
            background: var(--paper-raised);
        }

        /* ---------- Hero band ---------- */
        .hero-band {
            background: linear-gradient(155deg, var(--ink) 0%, var(--ink-soft) 60%, #16324a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 44px 44px;
            pointer-events: none;
        }
        /* Speed-line accent, evokes motion without being literal */
        .speed-line {
            position: absolute;
            right: -10%;
            top: 50%;
            width: 140%;
            height: 240px;
            transform: translateY(-50%) rotate(-6deg);
            background: linear-gradient(90deg, transparent, rgba(24, 89, 224, 0.16), transparent);
            pointer-events: none;
        }

        /* ---------- Signature: spec-sheet job card ---------- */
        .spec-card {
            background: var(--paper-raised);
            border: 1px solid var(--line);
            border-radius: 1rem;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .spec-card:hover {
            border-color: var(--blue);
            box-shadow: 0 20px 40px -20px rgba(13, 27, 42, 0.18);
            transform: translateY(-2px);
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
            font-weight: 500;
        }

        .btn-apply {
            position: relative;
            overflow: hidden;
            transition: all 0.25s ease;
        }
        .btn-apply::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transition: left 0.5s ease;
        }
        .btn-apply:hover::after { left: 100%; }
        .btn-apply:hover { transform: translateY(-1px); box-shadow: 0 10px 20px -8px rgba(24, 89, 224, 0.45); }

        .focus-ring:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24, 89, 224, 0.15);
        }

        @media (prefers-reduced-motion: reduce) {
            .spec-card, .btn-apply, .btn-apply::after { transition: none !important; }
        }
    </style>
</head>
<body x-data="{ modalOpen: false, selectedJob: '', selectedDesc: '' }">

    {{-- ============ HEADER / LOGO ============ --}}
    <header class="site-header">
        <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">

            {{-- Generated logo: mark + wordmark, no external image needed --}}
            <a href="/" class="flex items-center gap-3">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="10" fill="#0D1B2A"/>
                    <path d="M9 27L14.5 13H18L21 22.5L24 13H27.5L33 27H29.2L26 18L23 27H19.8L17 18L14 27H9Z" fill="#F6F7F9"/>
                    <rect x="9" y="29.5" width="22" height="2" rx="1" fill="#1859E0"/>
                </svg>
                <div class="leading-tight">
                    <p class="font-display font-extrabold text-lg tracking-tight" style="color: var(--ink);">TF MOTORS</p>
                    <p class="font-mono text-[10px] tracking-[0.25em] uppercase" style="color: var(--blue);">Careers</p>
                </div>
            </a>

            <a href="mailto:hello@tfmotors.com" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium" style="color: var(--slate);">
                hello@tfmotors.com
            </a>
        </div>
    </header>

    {{-- ============ HERO ============ --}}
    <section class="hero-band">
        <div class="speed-line"></div>
        <div class="max-w-6xl mx-auto px-6 py-20 md:py-28 relative">
            <p class="font-mono text-xs tracking-[0.25em] uppercase mb-5" style="color: #7ea6f2;">
                Open Positions — {{ $jobs->count() ?? 0 }}
            </p>
            <h1 class="font-display font-extrabold text-4xl md:text-6xl leading-[1.08] max-w-2xl" style="color: #ffffff;">
                Join the team behind every delivery.
            </h1>
            <p class="mt-6 max-w-lg text-base leading-relaxed" style="color: #aab8c9;">
                From the showroom floor to the service bay, TF Motors runs on people who care about the details. Find your next role below.
            </p>
        </div>
    </section>

    {{-- ============ JOB LISTINGS ============ --}}
    <section class="max-w-6xl mx-auto px-6 py-16 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse($jobs as $job)
            <div class="spec-card p-7 flex flex-col justify-between">
                <div>
                    <p class="font-mono text-[11px] tracking-[0.2em] uppercase mb-3" style="color: var(--blue);">
                        Open Role
                    </p>
                    <h2 class="font-display font-bold text-xl mb-4" style="color: var(--ink);">
                        {{ $job->title }}
                    </h2>

                    <div class="spec-row mb-3">
                        <span class="spec-label">Type</span>
                        <span class="spec-value">{{ strtoupper($job->employment_type) }}</span>
                        <span class="spec-label">Location</span>
                        <span class="spec-value">{{ $job->location }}</span>
                        <span class="spec-label">Salary</span>
                        <span class="spec-value">{{ $job->salary_range ?? 'COMPETITIVE' }}</span>
                    </div>

                    <p class="text-sm leading-relaxed mt-4" style="color: var(--slate);">
                        {{ Str::limit($job->description, 130) }}
                    </p>
                </div>

                <button @click="modalOpen = true; selectedJob = '{{ $job->title }}'; selectedDesc = '{{ addslashes($job->description) }}'"
                        class="btn-apply mt-6 w-full py-3 rounded-lg text-sm font-semibold text-white"
                        style="background: var(--blue);">
                    Submit Application
                </button>
            </div>
            @empty
            <div class="md:col-span-2 text-center py-24 rounded-2xl spec-card">
                <p class="font-display font-bold text-xl mb-2" style="color: var(--ink);">No open roles right now.</p>
                <p class="text-sm" style="color: var(--slate);">Check back soon, or send your resume directly to hello@tfmotors.com.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- ============ APPLICATION MODAL ============ --}}
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#0d1b2a]/55 backdrop-blur-sm" x-cloak
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div @click.outside="modalOpen = false"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="w-full max-w-lg rounded-2xl p-9 shadow-2xl" style="background: var(--paper-raised); border-top: 3px solid var(--blue);">

            <p class="font-mono text-[11px] tracking-[0.2em] uppercase mb-2" style="color: var(--blue);">Application</p>
            <h2 class="font-display font-extrabold text-2xl mb-6" style="color: var(--ink);" x-text="selectedJob"></h2>

            <div class="mb-6 p-5 rounded-xl text-sm leading-relaxed max-h-36 overflow-y-auto"
                 style="background: var(--paper); border: 1px solid var(--line); color: var(--slate);">
                <p x-text="selectedDesc"></p>
            </div>

            <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_title" x-model="selectedJob">
                <div class="space-y-3">
                    <input type="text" name="name" placeholder="Full name"
                           class="focus-ring w-full p-3.5 text-sm rounded-lg outline-none transition-all"
                           style="border: 1px solid var(--line); background: var(--paper);" required>
                    <input type="email" name="email" placeholder="Email address"
                           class="focus-ring w-full p-3.5 text-sm rounded-lg outline-none transition-all"
                           style="border: 1px solid var(--line); background: var(--paper);" required>

                    <label class="block p-4 rounded-lg text-center cursor-pointer transition-colors"
                           style="border: 1.5px dashed #c7cedb; background: var(--paper);">
                        <span class="text-sm font-medium" style="color: var(--slate);">Attach résumé (PDF)</span>
                        <input type="file" name="resume" class="hidden" required>
                    </label>

                    <button type="submit"
                    
                            class="btn-apply w-full py-3.5 rounded-lg font-semibold text-sm tracking-wide text-white"
                            style="background: var(--ink);">
                        Send Application
                    </button>
                </div>
            </form>

            <button @click="modalOpen = false" class="mt-5 text-xs w-full text-center transition-colors" style="color: var(--slate);">
                Cancel
            </button>
        </div>
    </div>

</body>
</html>