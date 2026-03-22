@extends('layouts.app')

@section('title', 'SafarEZY.com - Register')

@section('content')
<header class="grid place-items-center mt-36 min-h-1/4">
    <div>
        <h1 class="text-4xl font-semibold">REGISTER</h1>
    </div>
    <br>
    <div>
        <h1 class="text-4xl font-semibold">YOURSELF</h1>
    </div>
</header>
<main>
    <div class="mt-8 p-10">
        <div class="p-8">
            <a href="{{ url('/customer/choose') }}">
                <button class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold">CUSTOMER</button>
            </a>
        </div>

        <hr>

        <div class="p-8">
            <form action="{{ url('/set-role') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="1">
                <button type="submit" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold">AUTO OWNER</button>
            </form>
        </div>

        <hr>

        <div class="p-8">
            <form action="{{ url('/set-role') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="2">
                <button type="submit" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md rounded-xl text-lg font-semibold">CAR OWNER</button>
            </form>
        </div>
    </div>
</main>
@endsection
