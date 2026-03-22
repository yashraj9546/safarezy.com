@extends('layouts.app')

@section('title', 'Settings')
@section('show-nav', 'true')

@push('head-scripts')
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>
<script src="{{ asset('js/otp.js') }}"></script>
@endpush

@section('nav-links')
@if($role == '1')
<a href="{{ url('/rider/home') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 transition-colors">Home</a>
@elseif($role == '2')
<a href="{{ url('/car-owner/home') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 transition-colors">Home</a>
@else
<a href="{{ url('/customer/choose') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 transition-colors">Home</a>
@endif
<a href="{{ url('/settings') }}" class="block px-4 py-2 font-semibold text-gray-800 hover:bg-gray-100 transition-colors">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-bold text-red-500 hover:bg-red-50 transition-colors">Logout</a>
@endsection

@section('nav-links-desktop')
@if($role == '1')
<li class="nav-link px-4 py-2"><a href="{{ url('/rider/home') }}">Home</a></li>
@elseif($role == '2')
<li class="nav-link px-4 py-2"><a href="{{ url('/car-owner/home') }}">Home</a></li>
@else
<li class="nav-link px-4 py-2"><a href="{{ url('/customer/choose') }}">Home</a></li>
@endif
<li class="nav-link px-4 py-2"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="nav-link px-4 py-2 text-red-500 hover:bg-red-50"><a href="{{ url('/logout') }}">Logout</a></li>
@endsection

@section('content')
<main class="animate-fade-in-up pb-10">
    <div class="px-5 pt-8 pb-4">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Settings</h1>
    </div>

    <!-- Profile Card -->
    <div class="px-5 mb-8">
        <div class="bg-white/80 backdrop-blur-md border border-white/50 p-6 rounded-3xl shadow-lg flex items-center gap-6">
            <div class="relative">
                <img class="w-20 h-20 rounded-full object-cover shadow-md border-4 border-white" src="{{ e($photoURL) }}" alt="Profile photo">
                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ e($name) }}</h2>
                <p class="text-slate-500 font-medium mt-1 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    {{ e($mobile) ?: 'No Number Provided' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Options List -->
    <div class="px-5 flex flex-col gap-4">
        
        <!-- Change Number -->
        <button onclick="showPopup()" class="w-full bg-white/80 backdrop-blur-md border border-white/50 p-5 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-between group text-left">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">Update Phone</h3>
                    <p class="text-sm text-slate-500">Change your registered mobile</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Developer Info -->
        <a href="{{ url('/developer') }}" class="w-full bg-white/80 backdrop-blur-md border border-white/50 p-5 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-between group text-left block">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">About the Developer</h3>
                    <p class="text-sm text-slate-500">Meet the creator behind SafarEZY</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        <!-- Delete Account -->
        <button onclick="showPopup2()" class="w-full bg-white/80 backdrop-blur-md border border-white/50 p-5 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-between group text-left">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-red-500 text-lg">Delete Account</h3>
                    <p class="text-sm text-slate-500">Permanently remove your data</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-red-300 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

    </div>

    <!-- Branding Logo at Bottom -->
    <div class="mt-16 pb-8 flex justify-center opacity-60 hover:opacity-100 transition-opacity">
        <img src="{{ asset('images/safarezy.com.png') }}" alt="SafarEZY Logo" class="w-32 drop-shadow-lg grayscale hover:grayscale-0 transition-all duration-500">
    </div>

    <!-- Modals -->
    <!-- Update Phone Modal -->
    <div id="popup" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden z-[100] flex justify-center items-center p-4 transition-opacity">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden animate-fade-in-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-slate-800">Update Phone</h3>
                    <button onclick="closePopup()" class="text-slate-400 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <label class="block text-sm font-bold text-slate-700 mb-2" for="phoneNumber">Enter new mobile number</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500 font-semibold border-r border-slate-200 pr-2">
                        +91
                    </div>
                    <input type="text" id="phoneNumber" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl py-3 pl-14 pr-4 focus:outline-none focus:border-brand-500 focus:bg-white transition-colors" placeholder="XXXXXXXXXX" required>
                </div>
                
                <div id="recaptcha-container" class="mb-4"></div>
                
                <button id="sendOTPButton" onclick="sendOTP()" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-brand-600 transition-colors shadow-md flex justify-center items-center gap-2">
                    Send OTP
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
                
                <div id="otpSection" style="display: none;" class="mt-6 border-t border-slate-100 pt-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2" for="otp">Verification Code</label>
                    <input type="text" id="otp" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl py-3 px-4 focus:outline-none focus:border-brand-500 focus:bg-white transition-colors text-center text-lg tracking-[0.5em] font-mono" placeholder="------">
                    <button onclick="verifyOTP()" class="w-full mt-4 bg-green-500 text-white font-bold py-3 rounded-xl hover:bg-green-600 transition-colors shadow-md">
                        Verify & Save
                    </button>
                </div>

                <form id="storePhoneForm" action="{{ url('/settings/phone') }}" method="POST" style="display:none;">
                    @csrf
                    <input type="hidden" id="inputField1" name="inputField1">
                    <input type="submit" value="continue">
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="popup2" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden z-[100] flex justify-center items-center p-4 transition-opacity">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden animate-fade-in-up">
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-2">Delete Account?</h4>
                <p class="text-slate-500 text-sm mb-6">This action cannot be undone. All your rides, preferences and data will be permanently removed.</p>
                
                <form action="{{ url('/settings/delete') }}" method="POST">
                    @csrf
                    <div class="flex gap-3">
                        <button onclick="closePopup2()" type="button" class="w-1/2 bg-slate-100 text-slate-700 font-bold py-3 rounded-xl hover:bg-slate-200 transition-colors">Cancel</button>
                        <button type="submit" class="w-1/2 bg-red-500 text-white font-bold py-3 rounded-xl hover:bg-red-600 transition-colors shadow-md">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
    function showPopup() { document.getElementById("popup").classList.remove("hidden"); }
    function closePopup() { document.getElementById("popup").classList.add("hidden"); }
    function showPopup2() { document.getElementById("popup2").classList.remove("hidden"); }
    function closePopup2() { document.getElementById("popup2").classList.add("hidden"); }
</script>
@endpush
