<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TF Admin Panel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy-deep: #0a1f2c;
            --navy: #0f2b3d;
            --navy-light: #123447;
            --gold: #d4af37;
            --gold-light: #f3d980;
        }

        body { font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif; }

        .icon {
            display: inline-block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ---------- Entrance animations ---------- */
        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .app-header  { animation: fadeSlideDown .5s ease both; }
        .app-content { animation: fadeSlideUp .55s ease .06s both; }

        /* ---------- Sidebar brand glow ---------- */
        .brand-mark { position: relative; }
        .brand-glow {
            position: absolute;
            inset: -24px -16px auto -16px;
            height: 70px;
            background: radial-gradient(ellipse at 25% 0%, rgba(212, 175, 55, 0.22), transparent 70%);
            pointer-events: none;
        }

        /* ---------- Nav links ---------- */
        .nav-link {
            position: relative;
            overflow: hidden;
            transition: background-color .25s ease, color .25s ease, padding-left .25s ease;
        }
        .nav-link:hover { padding-left: 20px; }
        .nav-link .icon { transition: transform .25s ease, color .25s ease; }
        .nav-link:hover .icon { transform: translateX(2px); }

        .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(180deg, var(--gold), var(--gold-light));
            box-shadow: 0 0 10px rgba(212, 175, 55, .55);
        }

        /* ---------- Dropdown group ---------- */
        .nav-chevron { transition: transform .25s ease; }
        .nav-chevron.open { transform: rotate(180deg); }

        .nav-sublink {
            position: relative;
            transition: background-color .2s ease, color .2s ease, padding-left .2s ease;
        }
        .nav-sublink:hover { padding-left: 18px; }
        .nav-sublink.active {
            color: #fff;
            background: rgba(255,255,255,0.06);
        }
        .nav-sublink.active::before {
            content: "";
            position: absolute;
            left: -13px;
            top: 50%;
            width: 6px; height: 6px;
            transform: translateY(-50%);
            border-radius: 999px;
            background: var(--gold-light);
            box-shadow: 0 0 8px rgba(212, 175, 55, .7);
        }

        /* ---------- Logout button ---------- */
        .logout-btn {
            transition: background-color .2s ease, border-color .2s ease, color .2s ease, transform .15s ease;
        }
        .logout-btn:hover { transform: translateY(-1px); }
        .logout-btn:active { transform: translateY(0); }

        @media (prefers-reduced-motion: reduce) {
            .app-header, .app-content { animation: none; opacity: 1; }
            .nav-link, .nav-link .icon, .nav-chevron, .nav-sublink, .logout-btn { transition: none; }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black/50 lg:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-30 w-64 text-white transition-transform duration-300 ease-out lg:static lg:translate-x-0 flex flex-col shadow-2xl"
               style="background: linear-gradient(180deg, var(--navy-deep), var(--navy) 55%, var(--navy-light));">

            <div class="brand-mark h-16 flex items-center justify-between px-6 border-b border-white/10 flex-shrink-0">
                <div class="brand-glow"></div>
                <div class="relative">
                    <h1 class="text-2xl font-extrabold tracking-wide">
                        <span style="color: var(--gold-light);">TFMOTORS</span><span class="text-white">*</span>
                    </h1>
                    <p class="text-[10px] tracking-[0.15em] uppercase text-slate-400 mt-0.5">ប្រព័ន្ធគ្រប់គ្រងបុគ្គលិក</p>
                </div>
                <button @click="sidebarOpen = false" class="relative lg:hidden text-slate-400 hover:text-white transition-colors">
                    <svg class="icon" style="width: 20px; height: 20px;" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto"
                 x-data="{ openGroup: '{{ request()->routeIs('admin.employees.*') ? 'employees' : '' }}' }">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                          {{ request()->routeIs('admin.dashboard')
                              ? 'active bg-white/10 text-white'
                              : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="icon" style="width: 19px; height: 19px; color: var(--gold-light);" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                        <rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/>
                    </svg>
                    <span>
                        Dashboard
                        <span class="block text-[10px] font-normal text-slate-400 leading-none mt-0.5">ផ្ទាំងគ្រប់គ្រង</span>
                    </span>
                </a>

                {{-- Employees dropdown group --}}
                <div>
                    <button type="button"
                            @click="openGroup = (openGroup === 'employees' ? '' : 'employees')"
                            class="nav-link w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl font-medium
                                   {{ request()->routeIs('admin.employees.*')
                                       ? 'active bg-white/10 text-white'
                                       : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <span class="flex items-center gap-3">
                            <svg class="icon" style="width: 19px; height: 19px; color: var(--gold-light);" viewBox="0 0 24 24">
                                <circle cx="9" cy="8" r="3"/>
                                <path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                                <circle cx="17.5" cy="9" r="2.3"/>
                                <path d="M15.8 14a5 5 0 0 1 5.2 5"/>
                            </svg>
                            <span>
                                Employees
                                <span class="block text-[10px] font-normal text-slate-400 leading-none mt-0.5">បញ្ជីបុគ្គលិក</span>
                            </span>
                        </span>
                        <svg class="icon nav-chevron" :class="openGroup === 'employees' ? 'open' : ''"
                             style="width: 14px; height: 14px; color: #94a3b8;" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <div x-show="openGroup === 'employees'"
                         x-collapse
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="mt-1 ml-[22px] pl-4 border-l border-white/10 space-y-0.5"
                         style="display: none;">

                        <a href="{{ route('admin.employees.index') }}"
                           class="nav-sublink flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm
                                  {{ request()->routeIs('admin.employees.index') ? 'active font-semibold' : 'text-slate-400 hover:text-white' }}">
                            <svg class="icon" style="width: 15px; height: 15px;" viewBox="0 0 24 24">
                                <path d="M8 6h13M8 12h13M8 18h13"/>
                                <circle cx="3.5" cy="6" r="1"/>
                                <circle cx="3.5" cy="12" r="1"/>
                                <circle cx="3.5" cy="18" r="1"/>
                            </svg>
                            <span>
                                All Employees
                                <span class="block text-[10px] font-normal opacity-70 leading-none mt-0.5">បញ្ជីបុគ្គលិកទាំងអស់</span>
                            </span>
                        </a>

                        <a href="{{ route('admin.employees.create') }}"
                           class="nav-sublink flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm
                                  {{ request()->routeIs('admin.employees.create') ? 'active font-semibold' : 'text-slate-400 hover:text-white' }}">
                            <svg class="icon" style="width: 15px; height: 15px;" viewBox="0 0 24 24">
                                <circle cx="9" cy="8" r="3.2"/>
                                <path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                                <path d="M18 8v6M15 11h6"/>
                            </svg>
                            <span>
                                Add Employee
                                <span class="block text-[10px] font-normal opacity-70 leading-none mt-0.5">បន្ថែមបុគ្គលិក</span>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- System Users (Only for Admins) --}}
                @role('Admin')
                <a href="{{ route('admin.users.index') }}"
                   class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl font-medium mt-1.5
                          {{ request()->routeIs('admin.users.*')
                              ? 'active bg-white/10 text-white'
                              : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="icon" style="width: 19px; height: 19px; color: var(--gold-light);" viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M16 11h6"/>
                        <path d="M19 8v6"/>
                    </svg>
                    <span>
                        System Users
                        <span class="block text-[10px] font-normal text-slate-400 leading-none mt-0.5">គ្រប់គ្រងគណនី</span>
                    </span>
                </a>
                @endrole

            </nav>

            {{-- Logout --}}
            <div class="px-4 py-4 border-t border-white/10 flex-shrink-0">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="logout-btn w-full flex items-center justify-center gap-2 text-sm font-semibold text-rose-300 hover:text-white bg-rose-500/10 hover:bg-rose-500/80 border border-rose-400/20 hover:border-rose-400/0 px-4 py-2.5 rounded-xl">
                        <svg class="icon" style="width: 16px; height: 16px;" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <path d="M16 17l5-5-5-5"/>
                            <path d="M21 12H9"/>
                        </svg>
                        <span>ចាកចេញ <span class="text-xs font-normal opacity-70">· Logout</span></span>
                    </button>
                </form>
            </div>

            <div class="px-6 py-3 border-t border-white/10 flex-shrink-0">
                <p class="text-[10px] text-slate-500 tracking-wide">© {{ date('Y') }} TF Admin · v1.0</p>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header class="app-header h-16 bg-white/85 backdrop-blur border-b border-slate-200 shadow-sm flex items-center justify-between px-4 lg:px-8 z-10">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-800 transition-colors">
                        <svg class="icon" style="width: 22px; height: 22px;" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <span class="hidden sm:block w-1 h-6 rounded-full" style="background: linear-gradient(180deg, var(--gold), var(--gold-light));"></span>
                    <h2 class="text-xl font-bold text-slate-800 tracking-wide hidden sm:block">
                        @yield('header_title', 'Dashboard')
                    </h2>
                </div>

                <div class="relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu"
                            class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-full hover:bg-slate-100 transition-colors flex-shrink-0">
                        <span class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                              style="background: linear-gradient(135deg, var(--navy), var(--navy-light));">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </span>
                        <span class="hidden md:block text-sm font-semibold text-slate-700 whitespace-nowrap truncate max-w-[140px] min-w-0">
                            {{ auth()->user()->name ?? 'Admin' }}
                        </span>
                        <svg class="icon" :class="userMenu ? 'rotate-180' : ''"
                             style="width: 11px; height: 11px; color: #94a3b8; transition: transform .2s; flex-shrink: 0;"
                             viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </button>

                    <div x-show="userMenu"
                         @click.outside="userMenu = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-20 origin-top-right"
                         style="display: none;">
                        <div class="px-4 py-2.5 border-b border-slate-100">
                            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()->email ?? 'admin@tf.com' }}</p>
                        </div>
                        <form action="{{ route('admin.logout') }}" method="POST" class="px-2 pt-2">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-2 text-sm font-semibold text-rose-600 px-3 py-2 rounded-lg hover:bg-rose-50 transition-colors">
                                <svg class="icon" style="width: 15px; height: 15px;" viewBox="0 0 24 24">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <path d="M16 17l5-5-5-5"/>
                                    <path d="M21 12H9"/>
                                </svg>
                                <span>ចាកចេញ <span class="text-xs font-normal opacity-70">· Logout</span></span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="app-content flex-1 overflow-y-auto p-4 md:p-8 bg-slate-50">
                @yield('content')
            </div>

        </main>
    </div>

    @stack('scripts')
</body>
</html>