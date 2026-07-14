<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#8b6224">
    <meta name="color-scheme" content="light">
    <meta property="og:title" content="អាពាហ៍ពិពាហ៍ ឡុន ពេជ្រ & ជួប សុខធីតា">
    <meta property="og:description" content="សូមគោរពអញ្ជើញចូលរួមកម្មវិធីមង្គលការ ថ្ងៃអាទិត្យ ទី ០៣ ខែមករា ឆ្នាំ២០២៧">
    <title>Wedding Invitation | ឡុន ពេជ្រ & ជួប សុខធីតា</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bayon&family=Cormorant+Garamond:ital@1&family=Inter:wght@300;400;500;600;700&family=Moul&display=swap');

        :root{
            --color-bg-1:#fdfbf7;
            --color-bg-2:#f4ead9;
            --color-ink:#2d2a26;
            --color-ink-soft:#8a8074;
            --color-gold:#b8863b;
            --color-gold-light:#c9a25c;
            --color-gold-deep:#8b6224;
            --color-line:#e8ddc7;
            --color-blush:#f0c9c2;
            --color-peach:#f6d9b8;
            --color-ivory:#fbf6ee;
            --shadow-card:0 20px 60px -18px rgba(139,98,36,.28), 0 8px 24px -10px rgba(45,42,38,.10);
        }

        *{ -webkit-tap-highlight-color: transparent; box-sizing: border-box; }
        html{ -webkit-text-size-adjust: 100%; }

        body{
            font-family:'Inter', sans-serif;
            color: var(--color-ink);
            background: var(--color-ivory);
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

        /* Modern soft-blur wedding background — floating colour blobs, bokeh-style */
        .bg-blobs{
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .blob{
            position: absolute;
            border-radius: 50%;
            filter: blur(clamp(50px, 9vw, 110px));
            opacity: .55;
            will-change: transform;
        }
        .blob-1{
            width: clamp(220px, 42vw, 460px); height: clamp(220px, 42vw, 460px);
            top: -12%; left: -14%;
            background: var(--color-gold-light);
            animation: floatBlob 24s ease-in-out infinite;
        }
        .blob-2{
            width: clamp(200px, 38vw, 420px); height: clamp(200px, 38vw, 420px);
            top: -8%; right: -12%;
            background: var(--color-blush);
            animation: floatBlob 28s ease-in-out infinite reverse;
            animation-delay: -6s;
        }
        .blob-3{
            width: clamp(220px, 40vw, 440px); height: clamp(220px, 40vw, 440px);
            bottom: -14%; left: -10%;
            background: var(--color-peach);
            animation: floatBlob 26s ease-in-out infinite;
            animation-delay: -12s;
        }
        .blob-4{
            width: clamp(180px, 34vw, 380px); height: clamp(180px, 34vw, 380px);
            bottom: -10%; right: -8%;
            background: var(--color-gold-deep);
            opacity: .35;
            animation: floatBlob 22s ease-in-out infinite reverse;
            animation-delay: -3s;
        }
        @keyframes floatBlob{
            0%, 100%{ transform: translate(0,0) scale(1); }
            33%{ transform: translate(3%, 4%) scale(1.08); }
            66%{ transform: translate(-3%, -2%) scale(.95); }
        }
        @media (max-width: 480px){
            .blob{ opacity: .4; }
        }

        .font-khmer-title{ font-family:'Moul', cursive; }
        .font-khmer{ font-family:'Bayon', cursive; }
        .font-amp{ font-family:'Cormorant Garamond', serif; font-style: italic; }

        .gold-gradient-text{
            background: linear-gradient(to right, var(--color-gold-deep), var(--color-gold-light), var(--color-gold-deep));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 5s linear infinite;
        }

        .btn-gold{
            background: linear-gradient(135deg, var(--color-gold-light) 0%, var(--color-gold-deep) 100%);
            color: #fffdf9;
            transition: transform .3s cubic-bezier(.4,0,.2,1), box-shadow .3s cubic-bezier(.4,0,.2,1), filter .2s ease;
            min-height: 3.25rem;
        }
        .btn-gold:hover{ transform: translateY(-2px); box-shadow: 0 14px 28px -8px rgba(139,98,36,.45); }
        .btn-gold:active{ transform: translateY(0); filter: brightness(.97); }

        @keyframes shine{ to{ background-position: 200% center; } }
        @keyframes fadeInUp{ from{opacity:0; transform: translateY(18px);} to{opacity:1; transform: translateY(0);} }

        .animate-item{ opacity:0; animation: fadeInUp .8s cubic-bezier(.16,1,.3,1) forwards; }
        .delay-1{ animation-delay:.05s; } .delay-2{ animation-delay:.2s; }
        .delay-3{ animation-delay:.35s; } .delay-4{ animation-delay:.5s; } .delay-5{ animation-delay:.65s; }

        @media (prefers-reduced-motion: reduce){
            *, *::before, *::after{ animation-duration: .001ms !important; animation-iteration-count: 1 !important; transition-duration: .001ms !important; }
            .blob{ animation: none; }
        }

        .modern-input{
            background: rgba(255,255,255,.85);
            border: 1px solid var(--color-line);
            font-size: 16px; /* prevents iOS auto-zoom on focus */
            transition: border-color .25s ease, box-shadow .25s ease, background .25s ease;
            min-height: 3.25rem;
        }
        .modern-input:focus{
            background:#fff;
            border-color: var(--color-gold);
            box-shadow: 0 0 0 4px rgba(184,134,59,.15);
            outline: none;
        }
        select.modern-input{ -webkit-appearance:none; appearance:none; }

        :focus-visible{ outline: 2px solid var(--color-gold); outline-offset: 3px; border-radius: 4px; }

        .glass-card{
            background: rgba(255,255,255,.86);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.7);
            box-shadow: var(--shadow-card);
        }

        /* Ornamental corner brackets — signature detail */
        .corner{ position:absolute; width:clamp(20px,6vw,36px); height:clamp(20px,6vw,36px); border:1.5px solid var(--color-gold); opacity:.55; pointer-events:none; }
        .corner-tl{ top:clamp(.6rem,3vw,1.35rem); left:clamp(.6rem,3vw,1.35rem); border-right:none; border-bottom:none; }
        .corner-tr{ top:clamp(.6rem,3vw,1.35rem); right:clamp(.6rem,3vw,1.35rem); border-left:none; border-bottom:none; }
        .corner-bl{ bottom:clamp(.6rem,3vw,1.35rem); left:clamp(.6rem,3vw,1.35rem); border-right:none; border-top:none; }
        .corner-br{ bottom:clamp(.6rem,3vw,1.35rem); right:clamp(.6rem,3vw,1.35rem); border-left:none; border-top:none; }

        .divider-line{ height:1px; flex:1 1 auto; max-width:3.25rem; background: linear-gradient(to right, transparent, var(--color-line)); }
        .divider-line.reverse{ background: linear-gradient(to left, transparent, var(--color-line)); }
        .divider-diamond{ width:6px; height:6px; background:var(--color-gold); transform:rotate(45deg); border-radius:1px; flex-shrink:0; }

        /* Extra-small phones (<=359px) */
        @media (max-width:359px){
            .glass-card{ border-radius: 1.5rem; }
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center px-3 py-6 sm:p-8">

    <div class="bg-blobs" aria-hidden="true">
        <span class="blob blob-1"></span>
        <span class="blob blob-2"></span>
        <span class="blob blob-3"></span>
        <span class="blob blob-4"></span>
    </div>

    <div class="relative z-10 w-full max-w-md sm:max-w-lg animate-item">
        <div class="glass-card relative overflow-hidden rounded-[1.75rem] sm:rounded-[2rem] p-[clamp(1.25rem,5vw,3rem)]">

            <span class="corner corner-tl"></span>
            <span class="corner corner-tr"></span>
            <span class="corner corner-bl"></span>
            <span class="corner corner-br"></span>

            <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-[var(--color-gold-deep)] via-[var(--color-gold-light)] to-[var(--color-gold-deep)]"></div>

            <div class="text-center animate-item delay-1">
                <h1 class="font-khmer-title text-[clamp(2.1rem,9vw,3.6rem)] leading-tight mb-[clamp(1.5rem,5vw,2.5rem)] gold-gradient-text tracking-wide">អាពាហ៍ពិពាហ៍</h1>

                <div class="space-y-2 mb-8 sm:mb-10 relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-[var(--color-gold-light)] rounded-full blur-3xl opacity-10 -z-10"></div>
                    <p class="font-khmer-title text-[clamp(1.4rem,6vw,1.9rem)] text-gray-800 break-words">ឡុន ពេជ្រ</p>
                    <p class="font-amp text-[var(--color-gold)] text-2xl font-light">&amp;</p>
                    <p class="font-khmer-title text-[clamp(1.4rem,6vw,1.9rem)] text-gray-800 break-words">ជួប សុខធីតា</p>
                </div>
            </div>

            <div class="mb-8 sm:mb-10 text-center animate-item delay-2">
                <div class="p-[clamp(1.1rem,4vw,1.75rem)] bg-white/60 rounded-2xl border border-[var(--color-line)] shadow-sm w-full transition-transform duration-300 hover:scale-[1.015]">
                    <p class="text-[11px] sm:text-xs uppercase tracking-[0.2em] text-[var(--color-ink-soft)] mb-3 font-semibold">កាលបរិច្ឆេទ</p>
                    <p class="text-[clamp(1.05rem,4.2vw,1.35rem)] font-bold text-gray-800 mb-2 leading-snug">ថ្ងៃ អាទិត្យ ទី ០៣ ខែ មករា ឆ្នាំ ២០២៧</p>
                    <p class="text-sm sm:text-base text-[var(--color-gold-deep)] font-medium">វេលាម៉ោង ៥:០០ ល្ងាច</p>
                </div>
            </div>

            <div class="mb-10 sm:mb-12 text-center animate-item delay-3">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <span class="divider-line"></span>
                    <span class="divider-diamond"></span>
                    <h3 class="text-[11px] sm:text-xs uppercase tracking-[0.15em] text-[var(--color-ink-soft)] font-bold whitespace-nowrap">ទីតាំងមង្គលការ</h3>
                    <span class="divider-diamond"></span>
                    <span class="divider-line reverse"></span>
                </div>

                <div class="w-full aspect-[4/3] sm:aspect-[16/10] rounded-2xl overflow-hidden shadow-md border border-[var(--color-line)] transition-shadow duration-300 hover:shadow-lg relative group">
                    <iframe
                        src="https://maps.app.goo.gl/hgbzaxoKcm4iv4T3A?g_st=ic"
                        title="ទីតាំងកន្លែងរៀបការ លើ Google Maps"
                        class="absolute inset-0 w-full h-full"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                </div>

                <a href="https://maps.app.goo.gl/hgbzaxoKcm4iv4T3A?g_st=ic" target="_blank" rel="noopener"
                   class="mt-6 inline-flex items-center gap-2 text-[var(--color-gold-deep)] font-semibold hover:text-[var(--color-gold)] transition-colors bg-white px-6 min-h-[2.75rem] rounded-full border border-[var(--color-line)] shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm sm:text-base">បើកមើលក្នុង Google Maps</span>
                </a>
            </div>

            <div class="animate-item delay-4">
                <div class="bg-white/80 p-[clamp(1.25rem,5vw,2rem)] rounded-[1.5rem] border border-[var(--color-line)] shadow-sm">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="divider-line"></span>
                        <span class="divider-diamond"></span>
                        <h3 class="text-center font-bold text-gray-800 text-base sm:text-lg whitespace-nowrap">តើអ្នកនឹងមកចូលរួមដែរឬទេ?</h3>
                        <span class="divider-diamond"></span>
                        <span class="divider-line reverse"></span>
                    </div>

                    <form id="rsvpForm" action="{{ route('wedding.rsvp') }}" method="POST" class="space-y-4 sm:space-y-5">
                        @csrf
                        <div>
                            <label for="guest_name" class="sr-only">ឈ្មោះរបស់អ្នក</label>
                            <input id="guest_name" type="text" name="guest_name" placeholder="បញ្ចូលឈ្មោះរបស់អ្នក..." class="w-full p-4 modern-input rounded-xl" required autocomplete="name">
                        </div>

                        <div class="relative">
                            <label for="pax" class="sr-only">ចំនួនអ្នកចូលរួម</label>
                            <select id="pax" name="pax" class="w-full p-4 pr-11 modern-input rounded-xl text-gray-700 cursor-pointer" required>
                                <option value="" disabled selected>ជ្រើសរើសចំនួនអ្នកចូលរួម...</option>
                                <option value="1">ចូលរួមម្នាក់ឯង</option>
                                <option value="2">ចូលរួម ២ នាក់</option>
                                <option value="0">សុំអភ័យទោស មិនអាចចូលរួមបាន</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-gold py-4 rounded-xl font-bold tracking-wide text-sm sm:text-base flex justify-center items-center gap-2 mt-2">
                            បញ្ជាក់ការចូលរួម (RSVP)
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rsvpForm = document.getElementById('rsvpForm');
            if (rsvpForm) {
                rsvpForm.addEventListener('submit', function () {
                    Swal.fire({
                        title: 'កំពុងបញ្ជូន...',
                        html: '<p style="color:#8a8074;font-size:14px;">សូមរង់ចាំបន្តិច...</p>',
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
                    confirmButtonColor: '#b8863b',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'សុំអភ័យទោស!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ef4444',
                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl px-6' }
                });
            @endif
        });
    </script>
</body>
</html>