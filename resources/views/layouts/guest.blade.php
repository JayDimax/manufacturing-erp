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
<body class="font-sans antialiased bg-[#fafafb] text-[#262626] min-h-screen flex flex-col justify-center items-center p-4 selection:bg-[#1677ff] selection:text-white">
    <!-- Subtle Background Grid -->
    <div class="fixed inset-0 pointer-events-none opacity-60" style="background-image: radial-gradient(#1677ff 0.75px, transparent 0.75px), radial-gradient(circle at 10% 10%, rgba(22, 119, 255, 0.05) 0, transparent 40%), radial-gradient(circle at 90% 85%, rgba(64, 150, 255, 0.04) 0, transparent 40%); background-size: 24px 24px, 100% 100%, 100% 100%;"></div>

    <div class="relative z-10 w-full max-w-md">
        <div class="mb-6 flex justify-center">
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
        </div>

        <div class="w-full bg-white border border-[#f0f0f0] rounded-lg shadow-mantis p-6 sm:p-8">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </div>
</body>
</html>
