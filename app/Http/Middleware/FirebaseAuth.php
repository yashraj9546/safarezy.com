<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('uid')) {
            return redirect('/login')->with('error', 'Please sign in first.');
        }

        return $next($request);
    }
}
