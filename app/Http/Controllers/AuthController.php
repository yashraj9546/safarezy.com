<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('uid')) {
            return $this->redirectByRole(session('uid'));
        }
        return view('auth.login');
    }

    public function verifyToken(Request $request)
    {
        try {
            $idToken = $request->input('idToken');

            if (!$idToken || !is_string($idToken)) {
                return response()->json(['success' => false, 'error' => 'idToken is missing or invalid']);
            }

            $serviceAccountPath = base_path('firebase-credentials.json');

            if (!file_exists($serviceAccountPath)) {
                return response()->json(['success' => false, 'error' => 'Firebase credentials file not found']);
            }

            $factory = (new Factory)->withServiceAccount($serviceAccountPath);
            $auth = $factory->createAuth();

            $verifiedIdToken = $auth->verifyIdToken($idToken);

            $uid = $verifiedIdToken->claims()->get('sub');
            $user = $auth->getUser($uid);

            $email = $user->email;
            $name = $user->displayName;
            $photoURL = $user->photoUrl;

            session([
                'uid' => $uid,
                'email' => $email,
                'name' => $name,
                'photoURL' => $photoURL,
            ]);

            return response()->json(['success' => true]);

        } catch (\Throwable $e) {
            \Log::error('Firebase verify token error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function handlePostLogin()
    {
        $uid = session('uid');

        if (!$uid) {
            return redirect('/login');
        }

        $customer = CustomerInfo::find($uid);

        if (!$customer) {
            // New user - insert into database
            CustomerInfo::create([
                'uid' => $uid,
                'email' => session('email'),
                'name' => session('name'),
                'photo_url' => session('photoURL'),
                'created_at' => now(),
            ]);
            return redirect('/register');
        }

        return $this->redirectByRole($uid);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function setRole(Request $request)
    {
        $uid = session('uid');
        if (!$uid) {
            return redirect('/login');
        }

        $role = $request->input('role');
        $customer = CustomerInfo::find($uid);

        if ($customer) {
            $customer->diff = $role;
            $customer->save();
        }

        if ($role == '1') {
            return redirect('/rider/home');
        } elseif ($role == '2') {
            return redirect('/car-owner/home');
        } else {
            return redirect('/customer/choose');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    private function redirectByRole($uid)
    {
        $customer = CustomerInfo::find($uid);

        if (!$customer || !$customer->diff) {
            return redirect('/customer/choose');
        }

        if ($customer->diff == '1') {
            return redirect('/rider/home');
        } elseif ($customer->diff == '2') {
            return redirect('/car-owner/home');
        } else {
            return redirect('/customer/choose');
        }
    }
}
