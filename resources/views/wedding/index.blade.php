<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#7f1d1d">
    <meta name="color-scheme" content="light">
    <meta property="og:title" content="អាពាហ៍ពិពាហ៍ ឡុន ពេជ្រ & ជួប សុខធីតា">
    <meta property="og:description" content="សូមគោរពអញ្ជើញចូលរួមកម្មវិធីមង្គលការ ថ្ងៃអាទិត្យ ទី ០៣ ខែមករា ឆ្នាំ២០២៧">
    <title>Wedding Invitation | ឡុន ពេជ្រ & ជួប សុខធីតា</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bayon&family=Cormorant+Garamond:ital@1&family=Inter:wght@300;400;500;600;700&family=Moul&display=swap');

        :root {
            --color-red-deep: #7f1d1d;
            --color-red-main: #b91c1c;
            --color-red-light: #ef4444;
            --color-gold: #d4af37;
            --color-bg-base: #fdfaf9;
            --color-ink: #3f1818;
            --shadow-card: 0 24px 50px -12px rgba(127,29,29,0.15);
        }

        * { -webkit-tap-highlight-color: transparent; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-ink);
            background: var(--color-bg-base);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            padding: clamp(1rem, 4vw, 2rem) 1rem;
        }

        /* Soft Minimalist Background */
        .bg-gradient-mesh {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background: 
                radial-gradient(at 0% 0%, rgba(254, 202, 202, 0.4) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(253, 230, 138, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(252, 165, 165, 0.3) 0px, transparent 50%);
        }

        .font-khmer-title { font-family: 'Moul', cursive; }
        .font-amp { font-family: 'Cormorant Garamond', serif; font-style: italic; }

        .red-gradient-text {
            background: linear-gradient(135deg, var(--color-red-deep), var(--color-red-main));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        /* Glass Card - Cleaner & Whiter */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: var(--shadow-card);
            border-radius: 2rem;
        }

        /* Hero Image Arch */
        .hero-arch {
            border-radius: 12rem 12rem 0 0;
            overflow: hidden;
            position: relative;
        }
        .hero-arch::after {
            content: '';
            position: absolute; inset: 0;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 12rem 12rem 0 0;
            pointer-events: none;
        }

        /* Modern Inputs */
        .field-label {
            display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em;
            font-weight: 700; color: rgba(127,29,29,0.7); margin-bottom: 0.5rem;
        }
        .modern-input {
            background: #f9f9f9; border: 1.5px solid transparent;
            font-size: 16px; color: var(--color-ink); font-weight: 500;
            transition: all 0.25s ease;
        }
        .modern-input:focus {
            background: #fff; border-color: var(--color-red-main);
            box-shadow: 0 4px 12px rgba(185,28,28,0.1); outline: none;
        }

        /* Segmented Radio Cards */
        .pax-card {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem; border: 1.5px solid #f0f0f0; border-radius: 1rem;
            background: #fff; cursor: pointer; transition: all 0.2s ease;
        }
        .pax-radio { position: absolute; opacity: 0; width: 0; height: 0; }
        .pax-radio:checked + .pax-card {
            border-color: var(--color-red-main);
            background: rgba(185,28,28,0.03);
            box-shadow: 0 4px 12px rgba(185,28,28,0.08);
        }
        .pax-radio:checked + .pax-card .pax-icon { background: var(--color-red-main); color: #fff; }
        
        .pax-icon {
            width: 2.5rem; height: 2.5rem; border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            background: #f5f5f5; color: #888; transition: all 0.2s ease;
        }

        /* Gradient Button */
        .btn-submit {
            background: linear-gradient(135deg, var(--color-red-main), var(--color-red-deep));
            box-shadow: 0 8px 20px -6px rgba(153,27,27,0.5);
            transition: all 0.3s ease;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -8px rgba(153,27,27,0.6); }
        .spinner { width: 1.2rem; height: 1.2rem; border: 2.5px solid rgba(255,255,255,0.4); border-top-color: #fff; border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Animation */
        .fade-up { opacity: 0; transform: translateY(20px); animation: fadeUp 0.8s ease forwards; }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
        .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; } .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body class="flex flex-col items-center justify-center">

    <div class="bg-gradient-mesh" aria-hidden="true"></div>

    <div class="relative z-10 w-full max-w-md animate-item fade-up">
        <div class="glass-card p-4 sm:p-6 lg:p-8">

            <div class="hero-arch w-full h-[250px] mb-8 shadow-sm">
                <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1000&auto=format&fit=crop" 
                     alt="Pre-wedding Photo" 
                     class="w-full h-full object-cover">
            </div>

            <div class="text-center mb-8 fade-up delay-1">
                <p class="text-xs uppercase tracking-[0.2em] text-[var(--color-gold)] font-bold mb-3">សូមគោរពអញ្ជើញ</p>
                <h1 class="font-khmer-title text-4xl mb-6 red-gradient-text">អាពាហ៍ពិពាហ៍</h1>
                
                <div class="flex items-center justify-center gap-4 text-[#7f1d1d]">
                    <span class="font-khmer-title text-xl">ឡុន ពេជ្រ</span>
                    <span class="font-amp text-[var(--color-gold)] text-3xl">&</span>
                    <span class="font-khmer-title text-xl">ជួប សុខធីតា</span>
                </div>
            </div>

            <div class="space-y-3 mb-10 fade-up delay-2">
                <div class="flex items-center gap-4 p-4 bg-red-50/50 rounded-2xl border border-red-50">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#7f1d1d]">អាទិត្យ ០៣ មករា ២០២៧</p>
                        <p class="text-xs text-red-800/70 mt-1">វេលាម៉ោង ៥:០០ ល្ងាច</p>
                    </div>
                </div>

                <a href="https://maps.app.goo.gl/hgbzaxoKcm4iv4T3A?g_st=ic" target="_blank" class="flex items-center gap-4 p-4 bg-red-50/50 hover:bg-red-50 transition rounded-2xl border border-red-50 group">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 shrink-0 group-hover:scale-110 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-[#7f1d1d]">ទីតាំងកន្លែងរៀបការ</p>
                        <p class="text-xs text-red-800/70 mt-1">បើកមើលក្នុង Google Maps</p>
                    </div>
                    <svg class="w-5 h-5 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="pt-6 border-t border-gray-100 fade-up delay-3">
                <h3 class="text-center font-bold text-[#7f1d1d] text-lg mb-6">បញ្ជាក់ការចូលរួម (RSVP)</h3>

                <form id="rsvpForm" action="{{ route('wedding.rsvp') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="guest_name" class="field-label">ឈ្មោះរបស់អ្នក</label>
                        <input id="guest_name" type="text" name="guest_name" placeholder="ឧ. សុខ វាសនា..." class="w-full px-4 py-3.5 modern-input rounded-xl" required autocomplete="name">
                    </div>

                    <fieldset class="pt-2">
                        <legend class="field-label mb-3">ចំនួនអ្នកចូលរួម</legend>
                        <div class="space-y-3">
                            <label class="block relative">
                                <input type="radio" name="pax" value="1" class="pax-radio" required>
                                <div class="pax-card">
                                    <div class="pax-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg></div>
                                    <span class="font-bold text-[#3f1818]">ចូលរួមម្នាក់ឯង</span>
                                </div>
                            </label>

                            <label class="block relative">
                                <input type="radio" name="pax" value="2" class="pax-radio" required>
                                <div class="pax-card">
                                    <div class="pax-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 20v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1"/><circle cx="9" cy="7" r="3"/><path d="M23 20v-1a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                                    <span class="font-bold text-[#3f1818]">ចូលរួម ២ នាក់</span>
                                </div>
                            </label>

                            <label class="block relative">
                                <input type="radio" name="pax" value="0" class="pax-radio" required>
                                <div class="pax-card">
                                    <div class="pax-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/></svg></div>
                                    <span class="font-bold text-[#3f1818]">មិនអាចចូលរួមបាន</span>
                                </div>
                            </label>
                        </div>
                    </fieldset>

                    <button type="submit" id="rsvpSubmitBtn" class="w-full btn-submit text-white py-4 rounded-xl font-bold tracking-wide mt-4 flex justify-center items-center gap-2">
                        <span id="rsvpBtnLabel">បញ្ជូនព័ត៌មាន</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let isSubmitting = false;

        document.addEventListener('contextmenu', e => e.preventDefault());
        document.onkeydown = e => {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'C')) || (e.ctrlKey && e.key === 'U') || e.key === 'F5' || (e.ctrlKey && e.key === 'R')) return false;
        };
        window.addEventListener('beforeunload', e => { if (!isSubmitting) { e.preventDefault(); e.returnValue = ''; } });

        document.addEventListener("DOMContentLoaded", function () {
            const rsvpForm = document.getElementById('rsvpForm');
            const submitBtn = document.getElementById('rsvpSubmitBtn');
            const btnLabel = document.getElementById('rsvpBtnLabel');

            if (rsvpForm) {
                rsvpForm.addEventListener('submit', function () {
                    isSubmitting = true;
                    submitBtn.disabled = true;
                    btnLabel.textContent = 'កំពុងបញ្ជូន...';
                    const spinner = document.createElement('div');
                    spinner.className = 'spinner ml-2';
                    submitBtn.appendChild(spinner);

                    Swal.fire({
                        title: 'កំពុងដំណើរការ...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#fff',
                        didOpen: () => { Swal.showLoading(); }
                    });
                });
            }

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'ទទួលបានជោគជ័យ!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#b91c1c',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-8 py-3' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'មានបញ្ហា!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ef4444',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-8 py-3' }
                });
            @endif
        });
    </script>
</body>
</html>