<?php

namespace App\Http\Composers\Customer;

use App\Models\Category;
use App\Models\Order;
use Illuminate\View\View;

class
MenuComposer
{
    public function compose(View $view): void
    {
        $categories = Category::all();
        $view->with(['categories' => $categories]);
    }
}
