@extends('layouts.app')

@section('title', "Available Cars")
@section('show-nav', 'true')

@section('nav-links')
<a href="{{ url('/customer/car') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Back</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-bold text-red-500 hover:bg-red-50 rounded-md transition-colors">Logout</a>
@endsection

@section('nav-links-desktop')
<li class="nav-link px-4 py-2"><a href="{{ url('/customer/car') }}">Back</a></li>
<li class="nav-link px-4 py-2"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="nav-link px-4 py-2 text-red-500 hover:bg-red-50"><a href="{{ url('/logout') }}">Logout</a></li>
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="px-5 pt-8 pb-4">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Available Cars</h1>
        <h3 class="text-xl font-medium text-brand-600 mt-1">Hello, {{ e($name) }} 👋</h3>
    </div>

    <div class="px-5 mb-6">
        <div class="bg-indigo-50 border border-indigo-100 text-indigo-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm">
            <div class="p-2 bg-white rounded-full text-indigo-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-sm font-medium">Found rides from <strong class="text-indigo-900">{{ e($from) }}</strong> to <strong class="text-indigo-900">{{ e($to) }}</strong></p>
        </div>
    </div>

    <div class="px-5 flex flex-col gap-5">
        @if($showCards)
            @forelse($carOwners as $owner)
                <div class="bg-white rounded-3xl p-5 shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <img class="w-16 h-16 rounded-full object-cover border-2 border-slate-100 shadow-sm" src="{{ asset('images/user.png') }}" alt="Driver Photo">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">{{ e($owner->name) }}</h2>
                                <p class="text-sm text-slate-500 font-medium">{{ e($owner->veh_name) }} • {{ e($owner->veh_num) }}</p>
                                <p class="text-brand-600 font-extrabold mt-1 text-lg">{{ e($owner->fare) }}</p>
                            </div>
                        </div>
                        <div class="w-20 h-auto opacity-80 mix-blend-multiply">
                            <img src="{{ asset('images/pinpng.com-bolero-png-115186.png') }}" alt="Car" class="w-full object-contain">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-5 pt-4 border-t border-slate-100">
                        <div class="flex items-center gap-2">
                            @if($owner->status == 1)
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">Free</span>
                            @else
                                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                <span class="text-sm font-bold text-slate-500 uppercase tracking-wide">Busy</span>
                            @endif
                        </div>
                        <a href="tel:{{ $owner->{'mob.no'} }}" class="bg-brand-600 hover:bg-brand-500 text-white font-bold py-2.5 px-6 rounded-2xl shadow-md hover:shadow-lg transition-all active:scale-95 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.034 11.034 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                            Book
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-slate-100">
                    <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">No car owners available</h3>
                    <p class="text-slate-500 text-sm">We couldn't find any cars on this route right now.</p>
                </div>
            @endforelse
        @else
            <div class="bg-white rounded-3xl p-10 text-center shadow-sm border border-slate-100">
                <div class="inline-flex justify-center items-center w-20 h-20 rounded-full bg-indigo-50 mb-4 animate-bounce duration-1000">
                    <div class="text-4xl">🚀</div>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-800 mb-2">Coming Soon</h3>
                <p class="text-slate-500 font-medium">This route is currently under development for cars.</p>
            </div>
        @endif
    </div>
</main>
@endsection
