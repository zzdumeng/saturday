<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    use \Backpack\CRUD\CrudTrait;
    
    public function products() {
        return $this->hasMany('product');
    }

    public function addresses() {
        return $this->morphMany('App\Models\Address', 'addressable');
    }
}
