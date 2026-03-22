<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SafarEZY.com')</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#4f46e5', // Indigo instead of blue
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    @stack('head-scripts')
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); 
            min-height: 100vh; 
        }
        .app-container { 
            max-width: 600px; 
            margin: 0 auto; 
            min-height: 100vh; 
            background-color: rgba(255, 255, 255, 0.4); 
            backdrop-filter: blur(16px); 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); 
        }
        .glass-nav { 
            background: rgba(255, 255, 255, 0.7); 
            backdrop-filter: blur(10px); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.3); 
        }
        .nav-link {
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .nav-link:hover { color: #4f46e5; background-color: rgba(79, 70, 229, 0.05); border-radius: 0.5rem; }
        @yield('styles')
    </style>
    @stack('styles')
</head>
<body class="text-slate-800 antialiased @yield('body-class')">
    <div class="app-container relative flex flex-col">
        @hasSection('show-nav')
        <header class="glass-nav sticky top-0 z-50 px-5 py-4 flex justify-between items-center shadow-sm">
            <div class="font-bold text-2xl text-brand-600 tracking-tight flex items-center gap-2 hover:scale-105 transition-transform cursor-pointer">
                <a href="/customer/choose">SafarEZY</a>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button id="dropdownButton" class="text-3xl font-medium sm:hidden focus:outline-none text-slate-700 hover:text-brand-600 transition-colors">&#8801;</button>
            
            <!-- Desktop Nav -->
            <div class="hidden sm:block">
                <ul class="flex space-x-2 items-center">
                    @yield('nav-links-desktop')
                </ul>
            </div>
            
            <!-- Mobile Dropdown -->
            <div id="dropdownMenu" class="hidden absolute right-4 top-16 w-48 bg-white/95 backdrop-blur-md border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden transform transition-all origin-top-right">
                <div class="flex flex-col p-2 space-y-1">
                    @yield('nav-links')
                </div>
            </div>
        </header>
        @endif
        
        @yield('header-extra')

        <div class="flex-grow w-full relative z-10">
            @if(session('error'))
                <div class="mx-5 mt-5 p-4 text-sm bg-red-50 text-red-600 border border-red-200 rounded-xl font-medium shadow-sm flex items-center animate-bounce">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mx-5 mt-5 p-4 text-sm bg-green-50 text-green-600 border border-green-200 rounded-xl font-medium shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        const dropdownBtn = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
            window.addEventListener('click', (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
