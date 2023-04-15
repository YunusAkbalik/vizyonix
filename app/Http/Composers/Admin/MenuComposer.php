<?php

namespace App\Http\Composers\Admin;

use App\Models\Order;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $ordersCount = Order::query()->where('order_status', 1)->count();
        $view->with(['ordersCount' => $ordersCount]);
    }
}
