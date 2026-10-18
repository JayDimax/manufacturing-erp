<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Banana Chips Manufacturing System') }} | ERP</title>

    <!-- Mantis Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'><path fill='%231677ff' d='M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z'/></svg>" />

    <!-- Google Fonts: Public Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .feature-card {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px -6px rgba(22, 119, 255, 0.12), 0 4px 12px -2px rgba(0, 0, 0, 0.04);
            border-color: #91caff;
        }
    </style>
</head>
<body class="min-h-screen bg-[#fafafb] text-[#262626] font-sans antialiased selection:bg-[#1677ff] selection:text-white">
    <!-- Subtle Background Grid & Glow Pattern -->
    <div class="fixed inset-0 pointer-events-none opacity-60" style="background-image: radial-gradient(#1677ff 0.75px, transparent 0.75px), radial-gradient(circle at 10% 10%, rgba(22, 119, 255, 0.05) 0, transparent 40%), radial-gradient(circle at 90% 85%, rgba(64, 150, 255, 0.04) 0, transparent 40%); background-size: 24px 24px, 100% 100%, 100% 100%;"></div>

    <!-- Header / Navigation -->
    <header class="relative z-10 border-b border-[#f0f0f0] bg-white/90 backdrop-blur-md sticky top-0 transition-all">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1677ff] text-white shadow-sm shadow-[#1677ff]/20 transition-transform group-hover:scale-105">
                    <svg class="w-5 h-5" viewBox="0 0 40 40" fill="none">
                        <path fill="currentColor" d="M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z"/>
                    </svg>
                </span>
                <div>
                    <p class="font-headline text-base font-bold text-[#141414] leading-tight flex items-center gap-2">
                        {{ config('app.name', 'Banana Chips Manufacturing System') }}
                        <span class="rounded bg-[#e6f4ff] px-1.5 py-0.5 text-[10px] font-semibold text-[#1677ff] border border-[#bae0ff]">ERP</span>
                    </p>
                    <p class="text-[11px] font-medium tracking-wide text-[#8c8c8c]">Enterprise Resource Planning</p>
                </div>
            </a>

            <!-- Auth Navigation Links -->
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center gap-2 rounded-md bg-[#1677ff] px-4 py-2 text-sm font-medium text-white shadow-[0_2px_0_rgba(5,145,255,0.1)] transition hover:bg-[#4096ff] active:bg-[#0958d9]">
                            <span>Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center justify-center rounded-md border border-[#f0f0f0] bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-[#1677ff] hover:text-[#1677ff] shadow-[0_1px_2px_0_rgba(0,0,0,0.03)]">
                            Sign in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center rounded-md bg-[#1677ff] px-4 py-2 text-sm font-medium text-white shadow-[0_2px_0_rgba(5,145,255,0.1)] transition hover:bg-[#4096ff] active:bg-[#0958d9]">
                                Get started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <main class="relative z-10 mx-auto max-w-7xl px-5 sm:px-8">
        <section class="flex flex-col items-center justify-center pt-16 pb-20 text-center lg:pt-24 lg:pb-28">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-[#bae0ff] bg-[#e6f4ff] px-3.5 py-1.5 text-xs font-semibold text-[#1677ff] shadow-sm">
                <span class="flex h-2 w-2 rounded-full bg-[#1677ff] animate-pulse"></span>
                <span>Enterprise Resource Planning &middot; Purpose-Built for Manufacturing</span>
            </div>

            <!-- Main Heading -->
            <h1 class="mt-8 max-w-4xl font-headline text-4xl font-bold tracking-tight text-[#141414] sm:text-5xl lg:text-6xl leading-[1.15]">
                Your entire manufacturing operation,<br />
                <span class="bg-gradient-to-r from-[#1677ff] via-[#4096ff] to-[#0958d9] bg-clip-text text-transparent">seamlessly connected.</span>
            </h1>

            <!-- Subtitle -->
            <p class="mt-6 max-w-2xl text-base leading-relaxed text-[#8c8c8c] sm:text-lg">
                One unified workspace to manage procurement, inventory, production, quality control, 
                warehouse logistics, sales, and accounting with real-time end-to-end traceability.
            </p>

            <!-- Actions -->
            <div class="mt-10 flex flex-col items-center gap-3.5 sm:flex-row">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-[#1677ff] px-7 py-3 text-sm font-medium text-white shadow-[0_2px_0_rgba(5,145,255,0.15)] transition hover:bg-[#4096ff] active:bg-[#0958d9] sm:w-auto">
                            <span>Open Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-[#1677ff] px-7 py-3 text-sm font-medium text-white shadow-[0_2px_0_rgba(5,145,255,0.15)] transition hover:bg-[#4096ff] active:bg-[#0958d9] sm:w-auto">
                            <span>Get Started Now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" 
                           class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-[#f0f0f0] bg-white px-7 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:border-[#1677ff] hover:text-[#1677ff] sm:w-auto">
                            Sign in to existing account
                        </a>
                    @endauth
                @endif
            </div>

            <!-- Trust Pills -->
            <div class="mt-12 flex flex-wrap items-center justify-center gap-6 text-xs text-[#8c8c8c]">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#52c41a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Role-Based Access Control
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#52c41a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Full Audit Logging
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#52c41a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Multi-Level Approvals
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#52c41a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Real-Time Material Traceability
                </div>
            </div>
        </section>

        <!-- Feature Highlights Section -->
        <section class="pb-20 lg:pb-28">
            <div class="text-center">
                <span class="rounded bg-[#f0f5ff] px-2.5 py-1 text-xs font-semibold text-[#1677ff] border border-[#d6e4ff]">Core Modules</span>
                <h2 class="mt-3 font-headline text-2xl font-bold tracking-tight text-[#141414] sm:text-3xl">Everything you need to run production</h2>
                <p class="mt-2 text-sm text-[#8c8c8c] max-w-xl mx-auto">Comprehensive end-to-end modules designed for the complete manufacturing lifecycle.</p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Procurement -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#e6f4ff] text-[#1677ff]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Procurement</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Manage purchase requests, purchase orders, goods receipts, and supplier returns with multi-level approval workflows.
                    </p>
                </div>

                <!-- Inventory -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#f6ffed] text-[#389e0d]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Inventory</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Real-time stock tracking, inventory adjustments, multi-warehouse transfers, and perpetual stock card visibility.
                    </p>
                </div>

                <!-- Production / Manufacturing -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#fffbe6] text-[#d48806]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Manufacturing</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Bills of Materials (BOM), manufacturing orders, shop-floor production stages, material issuance, and output tracking.
                    </p>
                </div>

                <!-- Quality Control -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#fff1f0] text-[#cf1322]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Quality Control</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Incoming raw material and in-process inspections, non-conformance records (NCR), and corrective actions (CAPA).
                    </p>
                </div>

                <!-- Warehouse -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#f9f0ff] text-[#722ed1]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Warehouse Logistics</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Guided put-away, warehouse picking, bin & zone location management, and verified dispatch staging.
                    </p>
                </div>

                <!-- Sales & Export -->
                <div class="feature-card rounded-lg border border-[#f0f0f0] bg-white p-6 shadow-mantis">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#e6fffb] text-[#13c2c2]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-headline text-lg font-bold text-[#141414]">Sales & Export</h3>
                    <p class="mt-2 text-sm leading-relaxed text-[#595959]">
                        Customer sales orders, export shipments, packing lists, commercial invoices, and automated accounting queue postings.
                    </p>
                </div>
            </div>
        </section>

        <!-- Trust & Security Section -->
        <section class="pb-20 lg:pb-28">
            <div class="rounded-xl border border-[#d6e4ff] bg-gradient-to-br from-[#f0f5ff] via-[#ffffff] to-[#fafafb] p-8 sm:p-12 shadow-sm">
                <div class="grid gap-8 lg:grid-cols-[1.3fr_1fr] lg:items-center">
                    <div>
                        <span class="rounded bg-[#e6f4ff] px-2.5 py-1 text-xs font-semibold text-[#1677ff] border border-[#bae0ff]">Enterprise Security</span>
                        <h2 class="mt-3 font-headline text-2xl font-bold tracking-tight text-[#141414] sm:text-3xl">
                            Enterprise-grade security & governance
                        </h2>
                        <p class="mt-4 text-sm leading-relaxed text-[#595959]">
                            Role-based access control, cryptographic session management, comprehensive immutable audit logging, 
                            and segregation of duties ensure your manufacturing data remains secure and regulatory compliant.
                        </p>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            <div class="flex items-start gap-2.5 text-xs text-[#262626]">
                                <svg class="mt-0.5 w-4 h-4 shrink-0 text-[#1677ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Granular RBAC permissions</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs text-[#262626]">
                                <svg class="mt-0.5 w-4 h-4 shrink-0 text-[#1677ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Full transactional audit trail</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs text-[#262626]">
                                <svg class="mt-0.5 w-4 h-4 shrink-0 text-[#1677ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Multi-tier approval workflows</span>
                            </div>
                            <div class="flex items-start gap-2.5 text-xs text-[#262626]">
                                <svg class="mt-0.5 w-4 h-4 shrink-0 text-[#1677ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Encrypted session management</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-lg border border-[#f0f0f0] bg-white p-5 text-center shadow-sm hover:border-[#bae0ff] transition">
                            <p class="font-headline text-2xl font-bold text-[#1677ff]">RBAC</p>
                            <p class="mt-1 text-xs text-[#8c8c8c]">Access Control</p>
                        </div>
                        <div class="rounded-lg border border-[#f0f0f0] bg-white p-5 text-center shadow-sm hover:border-[#bae0ff] transition">
                            <p class="font-headline text-2xl font-bold text-[#1677ff]">SOC 2</p>
                            <p class="mt-1 text-xs text-[#8c8c8c]">Compliance Standard</p>
                        </div>
                        <div class="rounded-lg border border-[#f0f0f0] bg-white p-5 text-center shadow-sm hover:border-[#bae0ff] transition">
                            <p class="font-headline text-2xl font-bold text-[#1677ff]">AES-256</p>
                            <p class="mt-1 text-xs text-[#8c8c8c]">Data Encryption</p>
                        </div>
                        <div class="rounded-lg border border-[#f0f0f0] bg-white p-5 text-center shadow-sm hover:border-[#bae0ff] transition">
                            <p class="font-headline text-2xl font-bold text-[#52c41a]">99.9%</p>
                            <p class="mt-1 text-xs text-[#8c8c8c]">High Availability</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-[#f0f0f0] bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-5 py-6 sm:flex-row sm:px-8">
            <div class="flex items-center gap-2 text-xs text-[#8c8c8c]">
                <svg class="w-4 h-4 text-[#1677ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Role-based access &middot; Encrypted sessions &middot; Audited transactions
            </div>
            <p class="text-xs text-[#8c8c8c]">
                &copy; {{ date('Y') }} {{ config('app.name', 'Banana Chips Manufacturing System') }}. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
