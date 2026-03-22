@extends('layouts.app')

@section('title', "Rider's Location")
@section('show-nav', 'true')

@section('nav-links')
<a href="{{ url('/rider/home') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
<a href="{{ url('/settings') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
<a href="{{ url('/logout') }}" class="block px-4 py-2 font-semibold text-red-400">logout</a>
@endsection

@section('nav-links-desktop')
<li class="sm:text-xl sm:font-semibold sm:m-4 sm:mr-11"><a href="{{ url('/rider/home') }}">Home</a></li>
<li class="sm:text-xl sm:font-semibold sm:m-4"><a href="{{ url('/settings') }}">Settings</a></li>
<li class="sm:text-xl sm:font-semibold sm:m-4 text-red-400"><a href="{{ url('/logout') }}">logout</a></li>
@endsection

@section('content')
<main class="mt-1">
    <div class="m-5 pt-6 pb-6">
        <h1 class="text-4xl font-bold text-black">Set Your Location</h1>
        <h3 class="text-3xl font-semibold text-amber-300">{{ e($name) }}</h3>
    </div>

    <form action="{{ url('/rider/home') }}" method="GET">
        <div class="m-6">
            <label class="text-lg font-semibold">Select your current location:</label>
            <div class="mt-4 grid gap-3">
                @foreach(['College', 'Station', 'Dedor mod', 'Highway', 'Market'] as $location)
                <button type="submit" name="location" value="{{ $location }}" class="bg-gray-100 p-3 w-full drop-shadow-md rounded-xl text-lg font-light hover:bg-gray-200 transition">
                    {{ $location }}
                </button>
                @endforeach
            </div>
        </div>
    </form>
</main>
@endsection
