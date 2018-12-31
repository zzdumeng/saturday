<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function show($id) {
        $order = Order::with(['payment','items' , 'seller'])->find($id);
        return $order;
    }
}
