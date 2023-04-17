<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
        return view('customer.my-account.index')->with([
            'orders' => $orders
        ]);
    }
}
