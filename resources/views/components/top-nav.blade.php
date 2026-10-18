@auth
<header class="sticky top-0 z-30 flex h-16 items-center border-b border-[#f0f0f0] bg-white/95 px-4 backdrop-blur-md sm:px-6 lg:px-8" x-data="{ profileMenu: false, appsMenu: false, notifMenu: false }">
    <!-- Mobile hamburger -->
    <button class="mr-3 rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-800 lg:hidden" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full'); document.getElementById('sidebar-overlay').classList.toggle('hidden');">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <!-- Organization Switcher (Mantis style) -->
    <div class="hidden sm:flex items-center gap-2 mr-4">
        <button class="flex items-center gap-2 px-3 py-1.5 rounded-md border border-[#f0f0f0] bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
            <span class="flex h-5 w-5 items-center justify-center rounded bg-[#fa8c16] text-white">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </span>
            <span class="truncate max-w-[140px]">{{ config('app.name', 'Banana Chips ERP') }}</span>
            <span class="rounded bg-[#f5f5f5] px-1.5 py-0.5 text-[10px] text-slate-500 border border-[#f0f0f0]">Pro</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
    </div>

    <!-- Search with ⌘ K (desktop) -->
    <div class="relative hidden max-w-sm flex-1 md:block">
        <div class="flex items-center gap-2 bg-[#f5f5f5] border border-[#f0f0f0] rounded-md px-3 py-1.5 text-xs text-slate-400 focus-within:bg-white focus-within:border-[#1677ff] focus-within:ring-2 focus-within:ring-[#1677ff]/10 transition">
            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input class="w-full bg-transparent text-xs text-slate-700 outline-none placeholder:text-slate-400" placeholder="Search records, products, transactions..." />
            <kbd class="rounded border border-[#f0f0f0] bg-white px-1.5 py-0.5 text-[10px] text-slate-400 font-mono">⌘ K</kbd>
        </div>
    </div>

    <!-- Right side actions -->
    <div class="ml-auto flex items-center gap-1 sm:gap-2">
        <!-- App Grid Launcher -->
        <button class="rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition" title="Quick Apps">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
        </button>

        <!-- Notifications -->
        <button class="relative rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition" title="Notifications">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-1.5 right-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#1677ff] text-[9px] font-bold text-white">2</span>
        </button>

        <div class="h-6 w-px bg-[#f0f0f0] mx-1"></div>

        <!-- User dropdown (Mantis style) -->
        <div class="relative">
            <button @click="profileMenu = !profileMenu" @click.away="profileMenu = false" class="flex items-center gap-2.5 rounded-full p-1 pr-2 hover:bg-slate-50 transition border border-transparent hover:border-[#f0f0f0]">
                <div class="relative">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#1677ff] text-xs font-bold text-white shadow-sm">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}{{ substr(auth()->user()->name ?? '', -1, 1) }}
                    </span>
                    <span class="absolute bottom-0 right-0 h-2 w-2 rounded-full border border-white bg-[#52c41a]"></span>
                </div>
                <div class="hidden text-left sm:block">
                    <span class="block text-xs font-semibold text-slate-800 leading-tight">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="block text-[10px] text-slate-400">
                        @can('view-administration') Administrator
                        @elsecan('procurement-view') Procurement Officer
                        @elsecan('inventory-view') Warehouse Manager
                        @else Staff
                        @endcan
                    </span>
                </div>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-show="profileMenu" class="absolute right-0 top-12 w-64 rounded-lg border border-[#f0f0f0] bg-white p-2 shadow-mantis-dropdown z-50 transition-all" @click.away="profileMenu = false" style="display: none;">
                <div class="flex items-center gap-3 p-2.5 border-b border-[#f0f0f0] mb-1">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#1677ff] text-sm font-bold text-white">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}{{ substr(auth()->user()->name ?? '', -1, 1) }}
                    </span>
                    <div class="truncate">
                        <p class="truncate text-xs font-bold text-slate-900">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="truncate text-[11px] text-slate-400">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="flex w-full items-center gap-2.5 rounded-md px-3 py-2 text-xs font-medium text-slate-700 hover:bg-[#e6f4ff] hover:text-[#1677ff] transition">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Settings
                </a>
                <div class="my-1 h-px bg-[#f0f0f0]"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2.5 rounded-md px-3 py-2 text-xs font-medium text-[#cf1322] hover:bg-[#fff1f0] transition">
                        <svg class="w-4 h-4 text-[#cf1322]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
@endauth
