<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Backpack\CRUD\CrudTrait;
    //

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'tag_product');
    }
}
