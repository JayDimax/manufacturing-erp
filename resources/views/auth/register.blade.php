<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Banana Chips Manufacturing System') }} | Create Account</title>

    <!-- Mantis Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'><path fill='%231677ff' d='M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z'/></svg>" />

    <!-- Google Fonts: Public Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fafafb] text-[#262626] font-sans antialiased flex items-center justify-center p-4 sm:p-6 lg:p-8 selection:bg-[#1677ff] selection:text-white">
    <!-- Subtle Background Grid & Glow -->
    <div class="fixed inset-0 pointer-events-none opacity-60" style="background-image: radial-gradient(#1677ff 0.75px, transparent 0.75px), radial-gradient(circle at 10% 10%, rgba(22, 119, 255, 0.05) 0, transparent 40%), radial-gradient(circle at 90% 85%, rgba(64, 150, 255, 0.04) 0, transparent 40%); background-size: 24px 24px, 100% 100%, 100% 100%;"></div>

    <main class="relative z-10 w-full max-w-5xl">
        <div class="relative grid overflow-hidden rounded-2xl border border-[#f0f0f0] bg-white shadow-mantis-dropdown lg:grid-cols-[1.05fr_1fr]">
            <!-- Left Panel - Mantis Executive Branding -->
            <section class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br from-[#001d66] via-[#0958d9] to-[#1677ff] p-10 lg:flex lg:p-12 text-white">
                <!-- Background decorative shapes -->
                <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 h-64 w-64 rounded-full bg-[#1677ff]/30 blur-2xl pointer-events-none"></div>
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>

                <!-- Brand Header -->
                <div class="relative z-10 flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 backdrop-blur-md border border-white/20 text-white shadow-sm">
                        <svg class="w-6 h-6" viewBox="0 0 40 40" fill="none">
                            <path fill="currentColor" d="M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="font-headline text-base font-bold text-white leading-tight flex items-center gap-2">
                            {{ config('app.name', 'Banana Chips Manufacturing System') }}
                            <span class="rounded bg-white/20 px-1.5 py-0.5 text-[10px] font-semibold text-white backdrop-blur-sm">ERP</span>
                        </p>
                        <p class="text-[11px] font-medium tracking-wide text-blue-100/80">Enterprise Resource Planning</p>
                    </div>
                </div>

                <!-- Center Pitch -->
                <div class="relative z-10 my-8">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm border border-white/20">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        Platform Onboarding
                    </span>
                    <h1 class="mt-4 font-headline text-3xl font-bold leading-tight text-white lg:text-4xl">
                        Empower your team.<br />
                        <span class="text-blue-200">Scale operations.</span>
                    </h1>
                    <p class="mt-3 text-sm leading-relaxed text-blue-100/85">
                        Set up your enterprise profile to access real-time inventory management, automated purchase orders, and production control.
                    </p>

                    <div class="mt-6 space-y-2.5">
                        <div class="flex items-center gap-2.5 text-xs text-blue-100">
                            <svg class="w-4 h-4 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>End-to-End Batch & Lot Traceability</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-blue-100">
                            <svg class="w-4 h-4 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Multi-Warehouse Stock Movements</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-blue-100">
                            <svg class="w-4 h-4 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Quality Assurance & NCR Tracking</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Trust Badges -->
                <div class="relative z-10 flex items-center justify-between border-t border-white/15 pt-5 text-xs text-blue-100/80">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Verified Role Authorization</span>
                    </div>
                    <span class="font-semibold text-white">SOC 2 &middot; AES-256</span>
                </div>
            </section>

            <!-- Right Panel - Mantis Register Form -->
            <section class="flex flex-col justify-between p-8 sm:p-12 lg:p-14 bg-white">
                <div>
                    <!-- Mobile Logo -->
                    <div class="mb-8 lg:hidden">
                        <a href="{{ url('/') }}" class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1677ff] text-white shadow-sm">
                                <svg class="w-5 h-5" viewBox="0 0 40 40" fill="none">
                                    <path fill="currentColor" d="M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="font-headline text-base font-bold text-[#141414]">{{ config('app.name', 'Banana Chips Manufacturing System') }}</p>
                                <p class="text-[10px] uppercase tracking-wider text-[#8c8c8c]">Enterprise Resource Planning</p>
                            </div>
                        </a>
                    </div>

                    <!-- Header -->
                    <div>
                        <span class="rounded bg-[#e6f4ff] px-2.5 py-1 text-xs font-semibold text-[#1677ff] border border-[#bae0ff]">User Registration</span>
                        <h2 class="mt-3 font-headline text-2xl font-bold tracking-tight text-[#141414] sm:text-3xl">Create Account</h2>
                        <p class="mt-1 text-sm text-[#8c8c8c]">Fill in your details below to register your account.</p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                        @csrf

                        <!-- Full Name -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="name">
                                Full Name
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </span>
                                <input 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    placeholder="Juan Dela Cruz" 
                                    class="w-full rounded-md border border-[#d9d9d9] bg-white py-2.5 pl-10 pr-4 text-sm text-[#262626] placeholder-[#bfbfbf] outline-none transition focus:border-[#1677ff] focus:ring-2 focus:ring-[#1677ff]/10 hover:border-[#4096ff]"
                                />
                            </div>
                            @error('name')
                                <p class="mt-1.5 text-xs font-medium text-[#cf1322]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="email">
                                Email Address
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </span>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="username"
                                    placeholder="name@company.com" 
                                    class="w-full rounded-md border border-[#d9d9d9] bg-white py-2.5 pl-10 pr-4 text-sm text-[#262626] placeholder-[#bfbfbf] outline-none transition focus:border-[#1677ff] focus:ring-2 focus:ring-[#1677ff]/10 hover:border-[#4096ff]"
                                />
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs font-medium text-[#cf1322]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div x-data="{ show: false }">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="password">
                                Password
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input 
                                    id="password" 
                                    :type="show ? 'text' : 'password'" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    minlength="8"
                                    placeholder="Minimum 8 characters" 
                                    class="w-full rounded-md border border-[#d9d9d9] bg-white py-2.5 pl-10 pr-10 text-sm text-[#262626] placeholder-[#bfbfbf] outline-none transition focus:border-[#1677ff] focus:ring-2 focus:ring-[#1677ff]/10 hover:border-[#4096ff]"
                                />
                                <button 
                                    type="button" 
                                    @click="show = !show" 
                                    aria-label="Toggle password visibility" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition"
                                >
                                    <template x-if="!show">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </template>
                                    <template x-if="show">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </template>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs font-medium text-[#cf1322]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div x-data="{ showConfirm: false }">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="password_confirmation">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </span>
                                <input 
                                    id="password_confirmation" 
                                    :type="showConfirm ? 'text' : 'password'" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    minlength="8"
                                    placeholder="Repeat your password" 
                                    class="w-full rounded-md border border-[#d9d9d9] bg-white py-2.5 pl-10 pr-10 text-sm text-[#262626] placeholder-[#bfbfbf] outline-none transition focus:border-[#1677ff] focus:ring-2 focus:ring-[#1677ff]/10 hover:border-[#4096ff]"
                                />
                                <button 
                                    type="button" 
                                    @click="showConfirm = !showConfirm" 
                                    aria-label="Toggle password visibility" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition"
                                >
                                    <template x-if="!showConfirm">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </template>
                                    <template x-if="showConfirm">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </template>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-1.5 text-xs font-medium text-[#cf1322]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms notice -->
                        <div class="text-[11px] text-[#8c8c8c] pt-1">
                            By creating an account, you agree to our 
                            <span class="text-[#1677ff]">Terms of Service</span> and <span class="text-[#1677ff]">Privacy Policy</span>.
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-[#1677ff] px-4 py-2.5 text-sm font-medium text-white shadow-[0_2px_0_rgba(5,145,255,0.15)] transition hover:bg-[#4096ff] active:bg-[#0958d9]"
                            >
                                <span>Complete Registration</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center text-xs text-[#8c8c8c]">
                        Already have an enterprise account?
                        <a href="{{ route('login') }}" class="font-semibold text-[#1677ff] hover:text-[#4096ff] transition ml-1">
                            Sign in
                        </a>
                    </div>
                </div>

                <!-- Footer Support Note -->
                <p class="mt-8 text-center text-[11px] text-[#8c8c8c]">
                    Protected by enterprise-grade encryption &middot; Need assistance? Contact IT Support.
                </p>
            </section>
        </div>
    </main>
</body>
</html>
