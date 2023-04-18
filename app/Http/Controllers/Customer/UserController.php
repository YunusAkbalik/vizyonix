<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Countries;
use App\Models\Order;
use App\Models\UserAddress;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', auth()->user()->id)
            ->with('status')
            ->with('paymentStatus')
            ->orderByDesc('created_at')
            ->get();
        $user_addresses = UserAddress::query()
            ->where('user_id', auth()->user()->id)
            ->with('address')
            ->get();

        $countries = Countries::all();
        return view('customer.my-account.index')->with([
            'orders' => $orders,
            'user_addresses' => $user_addresses,
            'countries' => $countries,
        ]);
    }
}
