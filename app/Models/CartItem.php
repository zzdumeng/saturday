<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    protected $table = 'cartitems';
    protected $fillable=['product_id', 'user_id', 'spec', 'quantity'];

    public function product() {
        return $this->belongsTo('App\Models\Product')->with('seller');
    }
    // public function product() {
    //     return $this->belongsTo('App\Models\Product');
    // }
}
