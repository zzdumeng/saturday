<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    // protected $table = 'order';

    protected $fillable = ['user_id', 'address_id', 'status', 'type', ];
    public function products() {
        return $this->hasManyThrough('App\Models\Product', 'orderitem');
    }

    public function items() {
        return $this->hasMany('App\Models\OrderItem' )->with('product');
    }
    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function payment() {
        return $this->belongsTo('App\Models\Payment');
    }
}
