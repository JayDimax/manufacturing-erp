<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Banana Chips Manufacturing System')) | Mantis ERP</title>

    <!-- Mantis Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'><path fill='%231677ff' d='M20 2L4 11v18l16 9 16-9V11L20 2zm0 4.5l11.5 6.5-4.5 2.5-11.5-6.5L20 6.5zm-12 8.3l10.5 5.9v12.2L8 26.9V14.8zm14 18.1V20.7l10.5-5.9v12.1L22 32.9z'/></svg>" />

    <!-- Google Fonts: Public Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#fafafb] text-[#262626] font-sans min-h-screen" aria-busy="true">
    <x-page-loader theme="light" />
    <div class="min-h-screen flex">
        <!-- Mantis Sidebar -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 lg:pl-72 transition-all">
            <!-- Mantis Top Navigation / Header -->
            @include('components.top-nav')

            <!-- Page Content -->
            <main class="mx-auto max-w-[1500px] p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-lg border border-[#b7eb8f] bg-[#f6ffed] px-5 py-3.5 text-sm font-medium text-[#389e0d] flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#52c41a]"></span>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 rounded-lg border border-[#ffccc7] bg-[#fff1f0] px-5 py-3.5 text-sm font-medium text-[#cf1322] flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#ff4d4f]"></span>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Page Header -->
                @hasSection('page-header')
                    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                        <div>
                            <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-[#1677ff]">
                                <span>{{ config('app.name', 'Mantis ERP') }}</span>
                                <span class="text-slate-300">/</span>
                                <span class="text-slate-500">@yield('page-header')</span>
                            </div>
                            <h1 class="font-headline text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                                @yield('page-header')
                            </h1>
                            @hasSection('page-description')
                                <p class="mt-1 text-sm text-slate-500">@yield('page-description')</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 self-start rounded-md border border-[#f0f0f0] bg-white px-3 py-1.5 text-xs font-medium text-slate-500 sm:self-auto shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#52c41a]"></span>
                            Updated just now
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
