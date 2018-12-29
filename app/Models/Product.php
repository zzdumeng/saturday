<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $casts = ['images' => 'array'];

    public function setImagesAttribute($v) {
        $this->attributes['images'] = json_encode($v);
    }
    public function setSpecsAttribute($v) {
        $this->attributes['specs'] = json_encode($v);
    }
    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'tag_product');
    }
    public function reviews() {
        return $this->hasMany('App\Models\Review');
    }
    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function categories () {
        return $this->belongsToMany('App\Models\Category', 'category_product');
    }
}
