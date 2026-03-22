<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function home()
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        $needsMobile = $customer && $customer->{'mob.no'} == 0;

        return view('rider.home', [
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
            if ($request->has('free')) {
                $customer->status = 1;
                $customer->save();
                return redirect('/rider/location');
            } elseif ($request->has('busy')) {
                $customer->status = 0;
                $customer->save();
            }
        }

        return redirect('/rider/home');
    }
}
