@extends('layouts.app')

@section('title', 'About the Developer')
@section('show-nav', 'true')

@section('nav-links')
<a href="{{ url('/customer/choose') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Home</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-bold text-red-500 hover:bg-red-50 transition-colors">Logout</a>
@endsection

@section('nav-links-desktop')
<li class="nav-link px-4 py-2"><a href="{{ url('/customer/choose') }}">Home</a></li>
<li class="nav-link px-4 py-2"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="nav-link px-4 py-2 text-red-500 hover:bg-red-50"><a href="{{ url('/logout') }}">Logout</a></li>
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="px-5 pt-8 pb-4 text-center">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">About the Developer</h1>
        <p class="text-slate-500 font-medium mt-2 tracking-wide">The creator behind SafarEZY</p>
    </div>

    <div class="px-5 mt-6 mb-8 flex flex-col items-center">
        <!-- Developer Card -->
        <div class="w-full max-w-sm bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-2xl shadow-indigo-500/10 relative overflow-hidden group hover:shadow-indigo-500/20 transition-all duration-500">
            <!-- Decorative Background blurred blobs -->
            <div class="absolute -top-16 -right-16 w-48 h-48 bg-indigo-200 rounded-full blur-[3rem] opacity-60 group-hover:bg-indigo-300 group-hover:scale-125 transition-all duration-700 pointer-events-none"></div>
            <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-blue-100 rounded-full blur-[3rem] opacity-60 group-hover:bg-blue-200 group-hover:scale-125 transition-all duration-700 pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="relative mb-6 group-hover:scale-110 group-hover:-translate-y-2 transition-transform duration-500">
                    <img src="{{ asset('images/yash.jpeg') }}" alt="Yashraj" class="w-32 h-32 rounded-full object-cover shadow-xl border-4 border-white">
                    <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                </div>
                
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight mb-2">Yashraj</h2>
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-indigo-50 border border-indigo-100 rounded-full shadow-sm text-indigo-700 text-sm font-bold uppercase tracking-wider mb-5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    Full Stack Developer
                </span>
                
                <p class="text-center text-slate-600 font-medium leading-relaxed px-4">
                    Building premium, scalable, and highly interactive digital experiences.
                </p>

                <!-- Social Links -->
                <div class="flex justify-center gap-5 mt-8 w-full border-t border-slate-100/50 pt-6">
                    <a href="#" class="w-12 h-12 bg-white text-slate-700 hover:bg-slate-900 border border-slate-100 rounded-2xl flex items-center justify-center shadow-sm hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group/link">
                        <img src="{{ asset('images/github.png') }}" alt="GitHub" class="w-6 h-6 group-hover/link:invert transition-all duration-300">
                    </a>
                    <a href="#" class="w-12 h-12 bg-white text-slate-700 hover:bg-blue-600 border border-slate-100 rounded-2xl flex items-center justify-center shadow-sm hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group/link">
                        <img src="{{ asset('images/linkdin.png') }}" alt="LinkedIn" class="w-5 h-5 group-hover/link:brightness-0 group-hover/link:invert transition-all duration-300">
                    </a>
                    <a href="#" class="w-12 h-12 bg-white text-slate-700 hover:bg-pink-600 border border-slate-100 rounded-2xl flex items-center justify-center shadow-sm hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group/link">
                        <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-5 h-5 group-hover/link:brightness-0 group-hover/link:invert transition-all duration-300">
                    </a>
                </div>
            </div>
        </div>

        <!-- Go Back Button -->
        <div class="mt-12 w-full max-w-xs">
            <a href="javascript:history.back()" class="flex items-center justify-center gap-2 w-full px-6 py-4 bg-white/60 backdrop-blur-md border border-slate-200 rounded-2xl text-slate-700 font-bold shadow-sm hover:bg-white hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Go Back
            </a>
        </div>
    </div>
</main>
@endsection
