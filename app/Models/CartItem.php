<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    protected $table = 'cartitems';
    protected $fillable=['product_id', 'user_id', 'spec', 'quantity'];
}
