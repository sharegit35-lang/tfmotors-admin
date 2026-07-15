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

        :root{
            /* Professional Red & Gold Palette */
            --color-red-deep: #7f1d1d;
            --color-red-main: #b91c1c;
            --color-red-light: #ef4444;
            --color-gold: #d4af37;
            --color-gold-light: #f3e5ab;
            --color-bg-base: #fdfaf9;
            --color-line: #f3c9c9;
            --color-ink: #3f1818;
            --color-ink-soft: rgba(127,29,29,.65);
            --shadow-card: 0 20px 60px -18px rgba(153,27,27,.25), 0 8px 24px -10px rgba(127,29,29,.15);
        }

        *{ -webkit-tap-highlight-color: transparent; box-sizing: border-box; }
        html{ -webkit-text-size-adjust: 100%; }

        body{
            font-family:'Inter', sans-serif;
            color: var(--color-ink);
            background: var(--color-bg-base);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
            min-height: 100dvh;
            -webkit-font-smoothing: antialiased;
            padding-top: max(env(safe-area-inset-top), 1rem);
            padding-bottom: max(env(safe-area-inset-bottom), 1rem);
            padding-left: max(env(safe-area-inset-left), 0px);
            padding-right: max(env(safe-area-inset-right), 0px);
        }

        /* Red & Gold floating blur background */
        .bg-blobs{
            position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;
            background: linear-gradient(135deg, #fef2f2 0%, #fffbeb 100%);
        }
        .blob{ position:absolute; border-radius:50%; filter: blur(clamp(50px,9vw,110px)); opacity:.5; will-change:transform; }
        .blob-1{ width:clamp(220px,42vw,460px); height:clamp(220px,42vw,460px); top:-10%; left:-10%; background:#fecaca; animation: floatBlob 24s ease-in-out infinite; }
        .blob-2{ width:clamp(200px,38vw,420px); height:clamp(200px,38vw,420px); top:20%; right:-12%; background:#fde68a; animation: floatBlob 28s ease-in-out infinite reverse; animation-delay:-6s; }
        .blob-3{ width:clamp(220px,40vw,440px); height:clamp(220px,40vw,440px); bottom:-14%; left:10%; background:#fca5a5; animation: floatBlob 26s ease-in-out infinite; animation-delay:-12s; }
        @keyframes floatBlob{ 0%,100%{transform:translate(0,0) scale(1)} 33%{transform:translate(4%,5%) scale(1.05)} 66%{transform:translate(-3%,-2%) scale(.95)} }
        @media (max-width:480px){ .blob{ opacity:.35; } }

        .font-khmer-title{ font-family:'Moul', cursive; }
        .font-khmer{ font-family:'Bayon', cursive; }
        .font-amp{ font-family:'Cormorant Garamond', serif; font-style: italic; }

        .red-gradient-text{
            background: linear-gradient(to right, var(--color-red-deep), var(--color-red-main), var(--color-red-deep));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-size: 200% auto; animation: shine 5s linear infinite;
        }

        .btn-red-gradient{
            background: linear-gradient(135deg, var(--color-red-main) 0%, var(--color-red-deep) 100%);
            color:#fff; border:1px solid var(--color-red-deep);
            transition: transform .3s cubic-bezier(.4,0,.2,1), box-shadow .3s cubic-bezier(.4,0,.2,1), filter .2s ease, opacity .2s ease;
            min-height: 3.25rem;
        }
        .btn-red-gradient:hover{ transform: translateY(-2px); box-shadow: 0 14px 28px -8px rgba(153,27,27,.5); }
        .btn-red-gradient:active{ transform: translateY(0); filter: brightness(.95); }
        .btn-red-gradient:disabled{ opacity:.7; transform:none; cursor:not-allowed; }

        @keyframes shine{ to{ background-position: 200% center; } }
        @keyframes fadeInUp{ from{opacity:0; transform: translateY(18px);} to{opacity:1; transform: translateY(0);} }
        @keyframes spin{ to{ transform: rotate(360deg); } }

        .animate-item{ opacity:0; animation: fadeInUp .8s cubic-bezier(.16,1,.3,1) forwards; }
        .delay-1{ animation-delay:.1s; } .delay-2{ animation-delay:.25s; }
        .delay-3{ animation-delay:.4s; } .delay-4{ animation-delay:.55s; }

        @media (prefers-reduced-motion: reduce){
            *, *::before, *::after{ animation-duration:.001ms !important; animation-iteration-count:1 !important; transition-duration:.001ms !important; }
            .blob{ animation: none; }
        }

        :focus-visible{ outline: 2px solid var(--color-red-main); outline-offset: 3px; border-radius: 4px; }

        .field-label{
            display:block; font-size:11px; text-transform:uppercase; letter-spacing:.15em;
            font-weight:600; color: var(--color-ink-soft); margin-bottom:.6rem;
        }

        .modern-input{
            background: rgba(255,255,255,.9);
            border: 1px solid var(--color-line);
            font-size: 16px;
            color: var(--color-ink);
            font-weight: 500;
            transition: border-color .25s ease, box-shadow .25s ease, background .25s ease;
            min-height: 3.25rem;
        }
        .modern-input::placeholder{ color: rgba(63,24,24,.4); font-weight:400; }
        .modern-input:focus{
            background:#fff; border-color: var(--color-red-main);
            box-shadow: 0 0 0 4px rgba(185,28,28,.14); outline:none;
        }
        .input-icon{
            position:absolute; left:1rem; top:50%; transform:translateY(-50%);
            color: rgba(127,29,29,.4); pointer-events:none;
        }

        .glass-card{
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(254,226,226,.8);
            box-shadow: var(--shadow-card);
        }

        .corner{ position:absolute; width:clamp(20px,6vw,36px); height:clamp(20px,6vw,36px); border:2px solid var(--color-gold); opacity:.8; pointer-events:none; }
        .corner-tl{ top:clamp(.8rem,3vw,1.5rem); left:clamp(.8rem,3vw,1.5rem); border-right:none; border-bottom:none; }
        .corner-tr{ top:clamp(.8rem,3vw,1.5rem); right:clamp(.8rem,3vw,1.5rem); border-left:none; border-bottom:none; }
        .corner-bl{ bottom:clamp(.8rem,3vw,1.5rem); left:clamp(.8rem,3vw,1.5rem); border-right:none; border-top:none; }
        .corner-br{ bottom:clamp(.8rem,3vw,1.5rem); right:clamp(.8rem,3vw,1.5rem); border-left:none; border-top:none; }

        .divider-line{ height:1px; flex:1 1 auto; max-width:3.25rem; background: linear-gradient(to right, transparent, var(--color-red-main)); }
        .divider-line.reverse{ background: linear-gradient(to left, transparent, var(--color-red-main)); }
        .divider-diamond{ width:6px; height:6px; background:var(--color-gold); transform:rotate(45deg); border-radius:1px; flex-shrink:0; }

        /* Modern segmented RSVP option cards (replaces native <select>) */
        .pax-option{ display:block; cursor:pointer; }
        .pax-card{
            display:flex; align-items:center; gap:.85rem; min-height:3.25rem;
            padding:.85rem 1.1rem; border:1.5px solid var(--color-line); border-radius:1rem;
            background: rgba(255,255,255,.75);
            transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .pax-card:hover{ border-color: var(--color-red-light); }
        .pax-icon{
            width:2.15rem; height:2.15rem; border-radius:.7rem; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            background: rgba(185,28,28,.08); color: var(--color-red-main);
        }
        .pax-text{ font-weight:600; font-size:.92rem; color: var(--color-ink); }
        .pax-check{
            margin-left:auto; width:1.3rem; height:1.3rem; border-radius:50%; flex-shrink:0;
            border:1.5px solid var(--color-line); display:flex; align-items:center; justify-content:center;
            transition: border-color .2s ease, background .2s ease;
        }
        .pax-check svg{ width:.8rem; height:.8rem; opacity:0; transform:scale(.5); transition: opacity .2s ease, transform .2s ease; color:#fff; }

        .pax-radio{ position:absolute; opacity:0; width:1px; height:1px; }
        .pax-radio:checked + .pax-card{
            border-color: var(--color-red-main);
            background: linear-gradient(135deg, rgba(185,28,28,.07), rgba(212,175,55,.10));
            box-shadow: 0 6px 16px -8px rgba(185,28,28,.35);
        }
        .pax-radio:checked + .pax-card .pax-check{ border-color: var(--color-red-main); background: var(--color-red-main); }
        .pax-radio:checked + .pax-card .pax-check svg{ opacity:1; transform:scale(1); }
        .pax-radio:focus-visible + .pax-card{ outline:2px solid var(--color-red-main); outline-offset:2px; }

        .pax-card--decline .pax-icon{ background: rgba(107,114,128,.12); color:#6b7280; }
        .pax-radio.pax-radio--decline:checked + .pax-card{
            border-color:#9ca3af; background: rgba(107,114,128,.08); box-shadow:none;
        }
        .pax-radio.pax-radio--decline:checked + .pax-card .pax-check{ border-color:#6b7280; background:#6b7280; }

        .spinner{ width:1.1rem; height:1.1rem; border:2px solid rgba(255,255,255,.4); border-top-color:#fff; border-radius:50%; animation: spin .7s linear infinite; }
    </style>
</head>
<body class="flex flex-col items-center justify-center px-3 py-6 sm:p-8">

    <div class="bg-blobs" aria-hidden="true">
        <span class="blob blob-1"></span>
        <span class="blob blob-2"></span>
        <span class="blob blob-3"></span>
    </div>

    <div class="relative z-10 w-full max-w-md sm:max-w-lg animate-item">
        <div class="glass-card relative overflow-hidden rounded-[1.75rem] sm:rounded-[2rem] p-[clamp(1.25rem,5vw,3rem)]">

            <span class="corner corner-tl"></span>
            <span class="corner corner-tr"></span>
            <span class="corner corner-bl"></span>
            <span class="corner corner-br"></span>

            <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-[var(--color-gold)] via-[#fffbeb] to-[var(--color-gold)]"></div>

            <div class="text-center animate-item delay-1">
                <h1 class="font-khmer-title text-[clamp(2.1rem,9vw,3.6rem)] leading-tight mb-[clamp(1.5rem,5vw,2.5rem)] red-gradient-text tracking-wide">អាពាហ៍ពិពាហ៍</h1>

                <div class="space-y-2 mb-8 sm:mb-10 relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-[var(--color-red-main)] rounded-full blur-3xl opacity-10 -z-10"></div>
                    <p class="font-khmer-title text-[clamp(1.4rem,6vw,1.9rem)] text-[#7f1d1d] break-words">ឡុន ពេជ្រ</p>
                    <p class="font-amp text-[var(--color-gold)] text-3xl font-light">&amp;</p>
                    <p class="font-khmer-title text-[clamp(1.4rem,6vw,1.9rem)] text-[#7f1d1d] break-words">ជួប សុខធីតា</p>
                </div>
            </div>

            <div class="mb-8 sm:mb-10 text-center animate-item delay-2">
                <div class="p-[clamp(1.1rem,4vw,1.75rem)] bg-white/70 rounded-2xl border border-red-100 shadow-sm w-full transition-transform duration-300 hover:scale-[1.015]">
                    <p class="text-[11px] sm:text-xs uppercase tracking-[0.2em] text-red-800/60 mb-3 font-semibold">កាលបរិច្ឆេទ</p>
                    <p class="text-[clamp(1.05rem,4.2vw,1.35rem)] font-bold text-[#7f1d1d] mb-2 leading-snug">ថ្ងៃ អាទិត្យ ទី ០៣ ខែ មករា ឆ្នាំ ២០២៧</p>
                    <p class="text-sm sm:text-base text-[var(--color-gold)] font-bold">វេលាម៉ោង ៥:០០ ល្ងាច</p>
                </div>
            </div>

            <div class="mb-10 sm:mb-12 text-center animate-item delay-3">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="divider-line"></span>
                    <span class="divider-diamond"></span>
                    <h3 class="text-[11px] sm:text-xs uppercase tracking-[0.15em] text-red-800 font-bold whitespace-nowrap">ទីតាំងមង្គលការ</h3>
                    <span class="divider-diamond"></span>
                    <span class="divider-line reverse"></span>
                </div>

                <div class="w-full aspect-[4/3] sm:aspect-[16/10] rounded-2xl overflow-hidden shadow-md border border-red-200 transition-shadow duration-300 hover:shadow-lg relative group">
                    <iframe
                        src="https://maps.app.goo.gl/hgbzaxoKcm4iv4T3A?g_st=ic"
                        title="ទីតាំងកន្លែងរៀបការ លើ Google Maps"
                        class="absolute inset-0 w-full h-full"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <a href="https://maps.app.goo.gl/hgbzaxoKcm4iv4T3A?g_st=ic" target="_blank" rel="noopener"
                   class="mt-6 inline-flex items-center gap-2 text-[var(--color-red-main)] font-bold hover:text-[var(--color-red-deep)] transition-colors bg-white px-6 min-h-[2.75rem] rounded-full border border-red-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm sm:text-base">បើកមើលក្នុង Google Maps</span>
                </a>
            </div>

            <div class="animate-item delay-4">
                <div class="bg-white/90 p-[clamp(1.25rem,5vw,2rem)] rounded-[1.5rem] border border-red-100 shadow-sm">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="divider-line"></span>
                        <span class="divider-diamond"></span>
                        <h3 class="text-center font-bold text-[#7f1d1d] text-base sm:text-lg whitespace-nowrap">តើអ្នកនឹងមកចូលរួមដែរឬទេ?</h3>
                        <span class="divider-diamond"></span>
                        <span class="divider-line reverse"></span>
                    </div>

                    <form id="rsvpForm" action="{{ route('wedding.rsvp') }}" method="POST" class="space-y-5 sm:space-y-6">
                        @csrf

                        <div>
                            <label for="guest_name" class="field-label">ឈ្មោះរបស់អ្នក</label>
                            <div class="relative">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
                                </span>
                                <input id="guest_name" type="text" name="guest_name" placeholder="បញ្ចូលឈ្មោះរបស់អ្នក..." class="w-full pl-11 pr-4 py-4 modern-input rounded-xl" required autocomplete="name">
                            </div>
                        </div>

                        <fieldset>
                            <legend class="field-label">ចំនួនអ្នកចូលរួម</legend>
                            <div class="grid grid-cols-1 gap-3">

                                <label class="pax-option relative">
                                    <input type="radio" name="pax" value="1" class="pax-radio" required>
                                    <span class="pax-card">
                                        <span class="pax-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
                                        </span>
                                        <span class="pax-text">ចូលរួមម្នាក់ឯង</span>
                                        <span class="pax-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg></span>
                                    </span>
                                </label>

                                <label class="pax-option relative">
                                    <input type="radio" name="pax" value="2" class="pax-radio" required>
                                    <span class="pax-card">
                                        <span class="pax-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1"/><circle cx="9" cy="7" r="3"/><path d="M23 20v-1a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        </span>
                                        <span class="pax-text">ចូលរួម ២ នាក់</span>
                                        <span class="pax-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg></span>
                                    </span>
                                </label>

                                <label class="pax-option relative">
                                    <input type="radio" name="pax" value="0" class="pax-radio pax-radio--decline" required>
                                    <span class="pax-card pax-card--decline">
                                        <span class="pax-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/></svg>
                                        </span>
                                        <span class="pax-text">សុំអភ័យទោស មិនអាចចូលរួមបាន</span>
                                        <span class="pax-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg></span>
                                    </span>
                                </label>

                            </div>
                        </fieldset>

                        <button type="submit" id="rsvpSubmitBtn" class="w-full btn-red-gradient py-4 rounded-xl font-bold tracking-wide text-sm sm:text-base flex justify-center items-center gap-2 mt-2">
                            <span id="rsvpBtnLabel">បញ្ជាក់ការចូលរួម (RSVP)</span>
                            <svg id="rsvpBtnArrow" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rsvpForm = document.getElementById('rsvpForm');
            const submitBtn = document.getElementById('rsvpSubmitBtn');
            const btnLabel = document.getElementById('rsvpBtnLabel');
            const btnArrow = document.getElementById('rsvpBtnArrow');

            if (rsvpForm) {
                rsvpForm.addEventListener('submit', function () {
                    submitBtn.disabled = true;
                    btnArrow.style.display = 'none';
                    btnLabel.textContent = 'កំពុងបញ្ជូន...';
                    const spinner = document.createElement('span');
                    spinner.className = 'spinner';
                    submitBtn.appendChild(spinner);

                    Swal.fire({
                        title: 'កំពុងបញ្ជូន...',
                        html: '<p style="color:#7f1d1d;font-size:14px;">សូមរង់ចាំបន្តិច...</p>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#fffdf9',
                        didOpen: () => { Swal.showLoading(); }
                    });
                });
            }

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'អរគុណ!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#b91c1c',
                    customClass: { popup: 'rounded-2xl border border-red-100', confirmButton: 'rounded-xl px-6' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'សុំអភ័យទោស!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ef4444',
                    customClass: { popup: 'rounded-2xl border border-red-100', confirmButton: 'rounded-xl px-6' }
                });
            @endif
        });
    </script>
</body>
</html>