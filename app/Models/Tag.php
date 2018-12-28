<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tag';

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'tag_product');
    }
}
