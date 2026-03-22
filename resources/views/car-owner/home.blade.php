@extends('layouts.app')

@section('title', "Car Owner's Home")
@section('show-nav', 'true')
@section('body-class', 'bg-white')

@section('nav-links')
<a href="{{ url('/car-owner/home') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-semibold text-red-400">logout</a>
@endsection

@section('nav-links-desktop')
<li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="{{ url('/car-owner/home') }}">Home</a></li>
<li class="sm:text-xl sm:font-semibold sm:m-4"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="{{ url('/logout') }}">logout</a></li>
@endsection

@section('header-extra')
@if($needsMobile)
<div class="p-4 bg-red-500 text-white rounded-md m-2 font-bold">
    <a href="{{ url('/settings') }}">Please enter a valid mobile number in settings</a>
</div>
@endif
@endsection

@push('styles')
<style>
    .dot-green { height: 10px; width: 10px; background-color: green; border-radius: 50%; display: inline-block; margin-right: 8px; }
    .dot-red { height: 10px; width: 10px; background-color: red; border-radius: 50%; display: inline-block; margin-right: 8px; }
</style>
@endpush

@section('content')
<main class="mt-1">
    <div class="m-5 pt-6 pb-6">
        <h1 class="text-4xl font-bold text-black">Welcome</h1>
        <h3 class="text-3xl font-semibold text-amber-300">{{ e($name) }}</h3>
    </div>

    <div class="bg-white mt-4 flex flex-row">
        <img class="static rounded-[80px] -ml-24 h-[360px]" src="{{ asset('images/6387974.jpg') }}" alt="image not found">
        <div class="bg-white min-h-7 mt-20 sm:border border-indigo-600 absolute right-0 sm:mr-[200px] md:mr-[300px] lg:mr-[450px] rounded-3xl overflow-visible max-w-1/2 flex flex-col">
            <div class="m-3">
                <div>
                    <p class="text-xl font-medium text-center">Current status</p>
                </div>
                <div>
                    @if($status == 1)
                        <p class="text-lg font-medium text-center">Free<span class="dot-green"></span></p>
                    @else
                        <p class="text-lg font-medium text-center">Busy<span class="dot-red"></span></p>
                    @endif
                </div>
                <div>
                    <form action="{{ url('/car-owner/status') }}" method="POST">
                        @csrf
                        <button type="submit" name="submitx" value="submit1" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-xl font-light">Free</button>
                        <button type="submit" name="submitx" value="submit2" class="bg-gray-100 mt-2 p-1 w-full drop-shadow-md rounded-xl text-xl font-light">Busy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
