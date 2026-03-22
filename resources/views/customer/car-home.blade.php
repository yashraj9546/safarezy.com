@extends('layouts.app')

@section('title', "Find a Car")
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

@section('header-extra')
@if($needsMobile)
<div class="mx-5 mb-2 mt-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow-sm" role="alert">
    <p class="font-bold flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
        Action Required
    </p>
    <p class="mt-1 text-sm"><a href="{{ url('/settings') }}" class="underline hover:text-orange-900">Please enter a valid mobile number in settings</a> to book rides.</p>
</div>
@endif
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="px-5 pt-8 pb-4">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Car Search</h1>
        <h3 class="text-xl font-medium text-brand-600 mt-1">Hello, {{ e($name) }} 👋</h3>
    </div>
    
    <div class="px-5 mb-8">
        <p class="text-slate-500 font-medium tracking-wide">Where do you want to go?</p>
    </div>

    <form action="{{ url('/list/car') }}" method="GET" onsubmit="return validateForm()" class="px-5">
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-xl border border-white/60 mb-8 relative">
            <!-- From Input -->
            <div class="relative">
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Pickup Location</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="w-3 h-3 rounded-full bg-brand-500"></div>
                    </div>
                    <input type="text" id="dropdownInput1" name="dropdownInput1" required
                        class="w-full pl-10 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:outline-none focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-500/10 transition-all text-slate-800 font-semibold text-lg cursor-pointer"
                        placeholder="Select origin..." readonly>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <!-- Dropdown -->
                <div id="loc-dropdownMenu" class="hidden absolute z-20 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-2xl py-2 max-h-60 overflow-y-auto top-full">
                    @foreach(['College','Station','Dedor mod','Highway','Market'] as $loc)
                    <p class="option-item px-5 py-3 hover:bg-brand-50 hover:text-brand-600 cursor-pointer text-slate-700 font-medium transition-colors">{{ $loc }}</p>
                    @endforeach
                </div>
            </div>

            <!-- Connecting Line -->
            <div class="h-8 ml-5 border-l-2 border-dashed border-slate-300 my-1"></div>

            <!-- To Input -->
            <div class="relative">
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Dropoff Location</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-red-500 -ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="dropdownInput2" name="dropdownInput2" required
                        class="w-full pl-10 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:outline-none focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-500/10 transition-all text-slate-800 font-semibold text-lg cursor-pointer"
                        placeholder="Select destination..." readonly>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <!-- Dropdown 2 -->
                <div id="loc-dropdownMenu2" class="hidden absolute z-20 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-2xl py-2 max-h-60 overflow-y-auto top-full">
                    @foreach(['College','Station','Dedor mod','Highway','Market'] as $loc)
                    <p class="option-item2 px-5 py-3 hover:bg-brand-50 hover:text-brand-600 cursor-pointer text-slate-700 font-medium transition-colors">{{ $loc }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="w-full py-4 bg-slate-900 border border-transparent rounded-2xl shadow-lg text-white text-lg font-bold hover:bg-brand-600 hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2">
            Find Cars
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </button>
    </form>
    
    <div class="mt-12 flex justify-center px-5 opacity-90">
        <img src="{{ asset('images/undraw_travelers_kud9.png') }}" alt="travelers" class="max-w-xs w-full drop-shadow-xl hover:scale-105 transition-transform duration-500">
    </div>
</main>
@endsection

@push('scripts')
<script>
    function setupDropdown(inputId, menuId, itemClass) {
        const input = document.getElementById(inputId);
        const menu = document.getElementById(menuId);
        
        input.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });
        
        document.querySelectorAll(itemClass).forEach(item => {
            item.addEventListener('click', (e) => {
                input.value = e.target.textContent;
                menu.classList.add('hidden');
            });
        });
        
        window.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    }

    setupDropdown('dropdownInput1', 'loc-dropdownMenu', '.option-item');
    setupDropdown('dropdownInput2', 'loc-dropdownMenu2', '.option-item2');

    function validateForm() {
        const from = document.getElementById('dropdownInput1').value.trim();
        const to = document.getElementById('dropdownInput2').value.trim();
        if (!from || !to) { 
            alert("Please select both 'Pickup' and 'Dropoff' locations."); 
            return false; 
        }
        if (from === to) {
            alert("Pickup and Dropoff locations cannot be the same.");
            return false;
        }
        return true;
    }
</script>
@endpush
