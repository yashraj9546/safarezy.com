<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function chooseRide()
    {
        return view('customer.choose', [
            'name' => session('name'),
        ]);
    }

    public function autoHome()
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        $needsMobile = $customer && $customer->{'mob.no'} == 0;

        return view('customer.auto-home', [
            'name' => session('name'),
            'needsMobile' => $needsMobile,
        ]);
    }

    public function carHome()
    {
        $uid = session('uid');
        $customer = CustomerInfo::find($uid);

        $needsMobile = $customer && $customer->{'mob.no'} == 0;

        return view('customer.car-home', [
            'name' => session('name'),
            'needsMobile' => $needsMobile,
        ]);
    }
}
