<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show()
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        $role = $customer->diff ?? null;

        return view('settings.index', [
            'name' => session('name'),
            'photoURL' => session('photoURL'),
            'mobile' => $customer->{'mob.no'} ?? 0,
            'role' => $role,
        ]);
    }

    public function updatePhone(Request $request)
    {
        $uid = session('uid');
        $number = $request->input('inputField1');

        // Remove +91 prefix if present
        $number = preg_replace('/^\+91/', '', $number);

        if (!preg_match('/^[6-9][0-9]{9}$/', $number)) {
            return back()->with('error', 'Invalid phone number format');
        }

        $customer = CustomerInfo::find($uid);
        if ($customer) {
            $customer->{'mob.no'} = $number;
            $customer->save();
        }

        return back()->with('success', 'Phone number updated successfully');
    }

    public function deleteAccount()
    {
        $uid = session('uid');

        CustomerInfo::where('uid', $uid)->delete();

        session()->flush();

        return redirect('/');
    }
}
