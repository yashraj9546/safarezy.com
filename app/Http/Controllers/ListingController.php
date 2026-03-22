<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function autoList(Request $request)
    {
        $from = $request->input('dropdownInput1');
        $to = $request->input('dropdownInput2');

        $riders = CustomerInfo::where('status', 1)
            ->where('diff', 1)
            ->where('location', $from)
            ->whereRaw('`mob.no` != 0')
            ->get();

        return view('listing.auto-list', [
            'name' => session('name'),
            'from' => $from,
            'to' => $to,
            'riders' => $riders,
        ]);
    }

    public function carList(Request $request)
    {
        $from = $request->input('dropdownInput1');
        $to = $request->input('dropdownInput2');

        $carOwners = CustomerInfo::where('diff', 2)->get();

        return view('listing.car-list', [
            'name' => session('name'),
            'from' => $from,
            'to' => $to,
            'carOwners' => $carOwners,
            'showCards' => $from === 'College',
        ]);
    }
}
