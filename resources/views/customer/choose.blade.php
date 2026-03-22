@extends('layouts.app')

@section('title', 'Choose Your Ride')
@section('show-nav', 'true')

@section('nav-links')
<a href="{{ url('/customer/choose') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Home</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-bold text-red-500 hover:bg-red-50 rounded-md transition-colors">Logout</a>
@endsection

@section('nav-links-desktop')
<li class="nav-link px-4 py-2"><a href="{{ url('/customer/choose') }}">Home</a></li>
<li class="nav-link px-4 py-2"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="nav-link px-4 py-2 text-red-500 hover:bg-red-50"><a href="{{ url('/logout') }}">Logout</a></li>
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="flex flex-col items-center mt-12 mb-10 px-5 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-2 tracking-tight">Hey, {{ e($name) }}</h1>
        <p class="text-lg text-slate-500 font-medium">Where would you like to go today?</p>
    </div>

    <div class="flex flex-col gap-6 px-5 max-w-sm mx-auto w-full">
        <!-- Auto Card -->
        <a href="{{ url('/customer/auto') }}" class="group relative block w-full bg-white/80 backdrop-blur-md border border-white/50 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-100 rounded-full blur-2xl opacity-50 -mr-10 -mt-10 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-5">
                    <div class="text-5xl drop-shadow-sm group-hover:scale-110 transition-transform duration-300">🛺</div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Auto</h2>
                        <p class="text-sm text-slate-500 font-medium mt-1">Quick & affordable</p>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-brand-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                </div>
            </div>
        </a>

        <!-- Car Card -->
        <a href="{{ url('/customer/car') }}" class="group relative block w-full bg-white/80 backdrop-blur-md border border-white/50 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full blur-2xl opacity-50 -mr-10 -mt-10 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-5">
                    <div class="text-5xl drop-shadow-sm group-hover:scale-110 transition-transform duration-300">🚗</div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Car</h2>
                        <p class="text-sm text-slate-500 font-medium mt-1">Comfortable rides</p>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-brand-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                </div>
            </div>
        </a>
    </div>
</main>
@endsection
