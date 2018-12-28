<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    // protected $table = 'order';

    public function products() {
        return $this->hasManyThrough('App\Models\Product', 'orderitem');
    }
}
