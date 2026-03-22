@extends('layouts.app')

@section('title', "Available Auto Drivers")
@section('show-nav', 'true')

@push('head-scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('nav-links')
<a href="{{ url('/customer/auto') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Back</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 rounded-md transition-colors">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-bold text-red-500 hover:bg-red-50 rounded-md transition-colors">Logout</a>
@endsection

@section('nav-links-desktop')
<li class="nav-link px-4 py-2"><a href="{{ url('/customer/auto') }}">Back</a></li>
<li class="nav-link px-4 py-2"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="nav-link px-4 py-2 text-red-500 hover:bg-red-50"><a href="{{ url('/logout') }}">Logout</a></li>
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="px-5 pt-8 pb-4">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Available Autos</h1>
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
        @forelse ($riders as $rider)
            <div class="bg-white rounded-3xl p-5 shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300 relative overflow-hidden" data-rider-id="{{ e($rider->uid) }}">
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="relative">
                        <img class="w-16 h-16 rounded-full object-cover border-2 border-slate-100 shadow-sm" src="{{ asset('images/user.png') }}" alt="Driver Photo">
                        <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">{{ e($rider->name) }}</h2>
                        
                        <div class="flex items-center mt-1 text-sm text-slate-500 font-medium average-rating">
                            <span class="text-yellow-400 mr-1"><i class="fas fa-star"></i></span>
                            <span class="avg-rating-display text-slate-700">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4">
                    <button class="dwn-arrow text-slate-400 p-2 hover:bg-slate-50 rounded-full transition-colors cursor-pointer" title="Rate Rider">
                        <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <a href="tel:{{ $rider->{'mob.no'} }}" class="bg-brand-600 hover:bg-brand-500 text-white font-bold py-3 px-6 rounded-2xl shadow-md hover:shadow-lg transition-all active:scale-95 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.034 11.034 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                        Book Now
                    </a>
                </div>

                <!-- Rating Section, initially hidden -->
                <div class="rating-section hidden bg-slate-50 -mx-5 -mb-5 mt-4 p-5 border-t border-slate-100">
                    <h4 class="text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Rate this rider</h4>
                    <div class="stars flex gap-1 text-2xl text-slate-300 cursor-pointer">
                        <i class="fa-regular fa-star hover:text-yellow-400 transition-colors" data-rating="1"></i>
                        <i class="fa-regular fa-star hover:text-yellow-400 transition-colors" data-rating="2"></i>
                        <i class="fa-regular fa-star hover:text-yellow-400 transition-colors" data-rating="3"></i>
                        <i class="fa-regular fa-star hover:text-yellow-400 transition-colors" data-rating="4"></i>
                        <i class="fa-regular fa-star hover:text-yellow-400 transition-colors" data-rating="5"></i>
                    </div>
                    <div class="rating-message text-sm font-medium mt-2 text-brand-600"></div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-slate-100">
                <div class="inline-flex justify-center items-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">No autos available</h3>
                <p class="text-slate-500 text-sm">We couldn't find any drivers on this route right now.</p>
            </div>
        @endforelse
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.dwn-arrow').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.bg-white, [data-rider-id]');
            const ratingSection = card.querySelector('.rating-section');
            const icon = this.querySelector('svg');
            
            ratingSection.classList.toggle('hidden');
            if(ratingSection.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
<script src="{{ asset('js/rating.js') }}"></script>
@endpush
