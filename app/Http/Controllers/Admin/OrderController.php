<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->with('status')->with('detail')->get()->sortByDesc('created_at');
        return view('admin.order.index')->with([
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $statuses = OrderStatus::all();
        $paymentStatuses = PaymentStatus::all();
        $order = Order::query()->with('status')->with('detail')->with('paymentStatus')->find($id);
        return view('admin.order.show')->with([
            'order' => $order,
            'statuses' => $statuses,
            'paymentStatuses' => $paymentStatuses
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $order = Order::find($request->id);
            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->save();
            return response()->json(['message' => 'Sipariş durumları güncellendi.']);
        } catch (Exception $exception) {
            return response()->json(['message' => 'Sipariş durumları güncellenirken hata oluştu', 'error_message' => $exception->getMessage()], $exception->getCode() ?: 500);
        }
    }

}
