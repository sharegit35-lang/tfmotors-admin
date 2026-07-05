<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ចូលគណនីអ្នកគ្រប់គ្រង | Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Moul&family=Noto+Sans+Khmer:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #081521;
            --bg-panel: #0f2b3d;
            --gold: #d4af37;
            --gold-light: #f3d980;
            --gold-dim: rgba(212, 175, 55, 0.35);
            --cream: #f3ecd9;
            --cream-dim: rgba(243, 236, 217, 0.6);
            --error: #e4572e;
            --error-bg: rgba(228, 87, 46, 0.12);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            font-family: 'Inter', 'Noto Sans Khmer', sans-serif;
            background: radial-gradient(ellipse at 50% -10%, #16374d 0%, var(--bg-deep) 55%, #050d15 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            padding: 24px;
        }

        /* ---------- Ambient floating particles (incense / starlight) ---------- */
        .particles {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            bottom: -10px;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--gold-light);
            opacity: 0;
            box-shadow: 0 0 6px 1px var(--gold-light);
            animation: rise linear infinite;
        }

        @keyframes rise {
            0%   { transform: translateY(0) translateX(0); opacity: 0; }
            10%  { opacity: 0.8; }
            90%  { opacity: 0.4; }
            100% { transform: translateY(-100vh) translateX(var(--drift, 20px)); opacity: 0; }
        }

        /* ---------- Temple silhouette signature ---------- */
        .temple-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 220px;
            margin: 0 auto 8px;
        }

        .temple-wrap svg {
            width: 100%;
            display: block;
            overflow: visible;
        }

        .temple-path {
            fill: none;
            stroke: var(--gold);
            stroke-width: 1.4;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 620;
            stroke-dashoffset: 620;
            animation: draw 2.4s ease-out forwards;
            filter: drop-shadow(0 0 3px rgba(212,175,55,0.5));
        }

        @keyframes draw {
            to { stroke-dashoffset: 0; }
        }

        .temple-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 260px;
            height: 120px;
            transform: translate(-50%, -50%);
            background: radial-gradient(ellipse, rgba(212,175,55,0.18) 0%, transparent 70%);
            z-index: -1;
            animation: pulseGlow 4s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        /* ---------- Card ---------- */
        .card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
            background: linear-gradient(180deg, rgba(15,43,61,0.75), rgba(8,21,33,0.85));
            backdrop-filter: blur(14px);
            border: 1px solid var(--gold-dim);
            border-radius: 18px;
            padding: 38px 34px 32px;
            box-shadow:
                0 20px 60px -15px rgba(0,0,0,0.6),
                0 0 0 1px rgba(212,175,55,0.05) inset;
            opacity: 0;
            transform: translateY(24px) scale(0.98);
            animation: cardIn 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.3s forwards;
        }

        @keyframes cardIn {
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .card::before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 18px;
            padding: 1px;
            background: linear-gradient(135deg, var(--gold), transparent 30%, transparent 70%, var(--gold));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0.5;
            pointer-events: none;
        }

        .title-km {
            font-family: 'Moul', 'Noto Sans Khmer', serif;
            font-size: 22px;
            color: var(--gold-light);
            text-align: center;
            margin: 0 0 4px;
            letter-spacing: 0.5px;
            line-height: 1.5;
        }

        .title-en {
            text-align: center;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--cream-dim);
            margin: 0 0 28px;
        }

        .divider {
            width: 46px;
            height: 2px;
            margin: 0 auto 28px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            position: relative;
        }

        .divider::before {
            content: "◆";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 8px;
            color: var(--gold);
            background: transparent;
        }

        /* ---------- Errors ---------- */
        .error-box {
            background: var(--error-bg);
            border: 1px solid rgba(228, 87, 46, 0.4);
            color: #f4a98b;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 22px;
            font-size: 13px;
            animation: shake 0.4s ease;
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }

        /* ---------- Floating label fields ---------- */
        .field {
            position: relative;
            margin-bottom: 36px;
        }

        .field input {
            width: 100%;
            height: 58px;
            background: rgba(255, 255, 255, 0.03);
            border: none;
            border-bottom: 1.5px solid rgba(243, 236, 217, 0.25);
            border-radius: 4px 4px 0 0;
            padding: 26px 4px 8px;
            font-size: 15px;
            line-height: 1.2;
            color: var(--cream);
            font-family: 'Inter', 'Noto Sans Khmer', sans-serif;
            outline: none;
            transition: border-color 0.3s ease, background 0.3s ease;
        }

        .field input::placeholder { color: transparent; }

        .field input:focus,
        .field input:not(:placeholder-shown) {
            background: rgba(212, 175, 55, 0.04);
        }

        .field label {
            position: absolute;
            left: 4px;
            top: 9px;
            pointer-events: none;
            color: var(--cream-dim);
            transition: all 0.25s ease;
        }

        .field label .km { display: block; font-size: 13px; font-family: 'Noto Sans Khmer', sans-serif; line-height: 1.3; }
        .field label .en { display: block; font-size: 9px; letter-spacing: 1.5px; text-transform: uppercase; opacity: 0.65; margin-top: 3px; line-height: 1; }

        .field input:focus + label,
        .field input:not(:placeholder-shown) + label {
            top: -20px;
        }

        .field input:focus + label .km,
        .field input:not(:placeholder-shown) + label .km {
            font-size: 11px;
            color: var(--gold-light);
        }

        .field input:focus + label .en,
        .field input:not(:placeholder-shown) + label .en {
            display: none;
        }

        .field-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 1.5px;
            width: 0;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            transition: width 0.35s ease;
        }

        .field input:focus ~ .field-underline {
            width: 100%;
        }

        /* ---------- Submit button ---------- */
        .btn-submit {
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 6px;
            padding: 14px 4px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background: linear-gradient(135deg, #b8942c, var(--gold) 45%, var(--gold-light) 55%, #b8942c);
            background-size: 220% 100%;
            background-position: 0% 0%;
            color: #0f2b3d;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: background-position 0.6s ease, transform 0.15s ease, box-shadow 0.3s ease;
            box-shadow: 0 8px 20px -8px rgba(212, 175, 55, 0.5);
        }

        .btn-submit .km { font-family: 'Noto Sans Khmer', sans-serif; font-size: 15px; display: block; }
        .btn-submit .en { font-size: 10px; letter-spacing: 2px; text-transform: uppercase; opacity: 0.75; display: block; margin-top: 2px; }

        .btn-submit:hover {
            background-position: 100% 0%;
            box-shadow: 0 10px 26px -8px rgba(212, 175, 55, 0.7);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .footnote {
            text-align: center;
            margin-top: 26px;
            font-size: 11px;
            color: var(--cream-dim);
            letter-spacing: 0.5px;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        @media (max-width: 420px) {
            .card { padding: 30px 22px 26px; }
            .title-km { font-size: 19px; }
        }
    </style>
</head>
<body>

    <div class="particles" id="particles"></div>

    <div style="position:relative; z-index:1; width:100%; max-width:400px;">
        <div class="temple-wrap">
            <div class="temple-glow"></div>
            <svg viewBox="0 0 220 90" xmlns="http://www.w3.org/2000/svg">
                <path class="temple-path" d="
                    M10,80
                    L10,55 L18,55 L18,45 L26,45 L26,55 L34,55 L34,80
                    M50,80
                    L50,40 L58,40 L58,28 L54,20 L62,20 L58,28 L66,28 L66,40 L74,40 L74,80
                    M92,80
                    L92,25 L100,25 L100,10 L94,2 L106,2 L100,10 L108,10 L108,25 L116,25 L116,80
                    M134,80
                    L134,40 L142,40 L142,28 L138,20 L146,20 L142,28 L150,28 L150,40 L158,40 L158,80
                    M174,80
                    L174,55 L182,55 L182,45 L190,45 L190,55 L198,55 L198,80
                    M4,80 L206,80
                " />
            </svg>
        </div>

        <div class="card">
            <h1 class="title-km">ចូលគណនីអ្នកគ្រប់គ្រង</h1>
            <p class="title-en">Admin Login</p>
            <div class="divider"></div>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf

                <div class="field">
                    <input type="email" name="email" id="email" required placeholder=" ">
                    <label for="email">
                        <span class="km">អាសយដ្ឋានអ៊ីមែល</span>
                        <span class="en">Email Address</span>
                    </label>
                    <span class="field-underline"></span>
                </div>

                <div class="field">
                    <input type="password" name="password" id="password" required placeholder=" ">
                    <label for="password">
                        <span class="km">ពាក្យសម្ងាត់</span>
                        <span class="en">Password</span>
                    </label>
                    <span class="field-underline"></span>
                </div>

                <button type="submit" class="btn-submit">
                    <span class="km">ចូលប្រើប្រាស់</span>
                    <span class="en">Login</span>
                </button>
            </form>

            <p class="footnote">© {{ date('Y') }} · Secured Admin Access</p>
        </div>
    </div>

    <script>
        // Generate ambient floating particles
        const container = document.getElementById('particles');
        const count = 26;
        for (let i = 0; i < count; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const left = Math.random() * 100;
            const duration = 8 + Math.random() * 10;
            const delay = Math.random() * 10;
            const drift = (Math.random() * 60 - 30) + 'px';
            p.style.left = left + 'vw';
            p.style.animationDuration = duration + 's';
            p.style.animationDelay = delay + 's';
            p.style.setProperty('--drift', drift);
            container.appendChild(p);
        }
    </script>
</body>
</html>