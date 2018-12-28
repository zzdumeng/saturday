<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $table = 'seller';

    public function products() {
        return $this->hasMany('product');
    }

    public function addresses() {
        return $this->morphMany('App\Models\Address', 'addressable');
    }
}
