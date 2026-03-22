<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafarEZY.com - Your Premium Ride</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: { 'float': 'float 6s ease-in-out infinite' },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #020617 0%, #1e1b4b 100%); 
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
        }
        .hero-container {
            max-width: 600px;
            text-align: center;
            padding: 3rem 2rem;
            position: relative;
            z-index: 10;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 4rem 2rem;
        }
        .ambient-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, rgba(0,0,0,0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            filter: blur(50px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.6);
        }
    </style>
</head>
<body class="antialiased">
    <div class="ambient-glow animate-float"></div>
    <div class="hero-container">
        <div class="glass-card flex flex-col items-center">
            <img src="{{ asset('images/safarezy.com.png') }}" alt="SafarEZY Logo" class="mx-auto mb-8 w-36 h-auto drop-shadow-2xl hover:scale-110 transition-transform duration-500">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-100 to-indigo-300">
                SafarEZY
            </h1>
            <p class="text-xl text-indigo-100/70 mb-10 font-medium">Your premium ride booking experience</p>
            
            <a href="{{ url('/login') }}" class="btn-primary inline-flex items-center justify-center text-white font-bold px-10 py-4 rounded-full text-lg w-full sm:w-auto">
                Get Started
                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
        <p class="mt-10 text-sm text-slate-500 font-medium tracking-wide">© {{ date('Y') }} SafarEZY. All rights reserved.</p>
    </div>
</body>
</html>
