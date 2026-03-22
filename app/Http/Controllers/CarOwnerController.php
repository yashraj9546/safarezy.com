<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class CarOwnerController extends Controller
{
    public function home()
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        $needsMobile = $customer && $customer->{'mob.no'} == 0;

        return view('car-owner.home', [
            'name' => session('name'),
            'status' => $customer->status ?? 0,
            'needsMobile' => $needsMobile,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        if ($customer) {
            if ($request->input('submitx') === 'submit1') {
                $customer->status = 1;
            } elseif ($request->input('submitx') === 'submit2') {
                $customer->status = 0;
            }
            $customer->save();
        }

        return redirect('/car-owner/home');
    }
}
