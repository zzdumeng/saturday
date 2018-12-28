<?php
namespace App\Helper;

use App\Models\Address;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Footprint;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Tag;
use App\Models\User;


class Creator {
    static function createAddress($arr) {

    }
    static function createProduct($arr) {
        $p = new Product($arr);
        $p->save();
    }
}