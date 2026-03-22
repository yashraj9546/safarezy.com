@extends('layouts.app')

@section('title', 'SafarEZY.com - Sign In')

@push('head-scripts')
<script src="https://www.gstatic.com/firebasejs/10.0.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.0.0/firebase-auth-compat.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
        storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
        messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
        appId: "{{ env('FIREBASE_APP_ID') }}",
        measurementId: "{{ env('FIREBASE_MEASUREMENT_ID') }}"
    };

    const app = firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();

    function signInWithGoogle() {
        const provider = new firebase.auth.GoogleAuthProvider();
        auth.signInWithPopup(provider)
            .then((result) => {
                const user = result.user;
                user.getIdToken().then((idToken) => {
                    sendTokenToServer(idToken);
                });
            })
            .catch((error) => {
                console.error("Google Sign-In Error:", error);
            });
    }

    function sendTokenToServer(idToken) {
        fetch('{{ url("/verify-token") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ idToken: idToken })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Token Verified");
                window.location.href = '{{ url("/post-login") }}';
            } else {
                console.error("Token verification failed:", data.error);
            }
        })
        .catch(error => {
            console.error("Error sending token: ", error);
        });
    }
</script>
@endpush

@section('content')
<header class="grid place-items-center mt-36 min-h-1/4">
    <div class="max-w-40">
        <img src="{{ asset('images/4957136.jpg') }}" alt="SafarEZY">
    </div>
</header>
<main>
    <div class="mt-8 p-10">
        <div class="grid place-content-center">
            <h3 class="text-2xl font-bold">SIGN-IN</h3>
        </div>
        <div class="p-8" id="auth-container">
            <button id="login-button" onclick="signInWithGoogle()" class="bg-gray-100 mb-2 p-1 w-full drop-shadow-md text-lg font-light flex items-center justify-center">
                <img class="mr-2" src="{{ asset('images/icons8-google-30.png') }}" alt="Google">Google
            </button>
        </div>
    </div>
</main>
@endsection
