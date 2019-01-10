<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Backpack\CRUD\CrudTrait;
    //
    public function products () {
        return $this->belongsToMany('App\Models\Product', 'category_product');
    }

    public function getFirstRowAttribute() {
        return $this->products()->with('seller')->limit(4)->get();
    }
    public function getPagedProductsAttribute() {
        return $this->products()->paginate(12);
    }

    public function categories() {
        if($this->level<2)
        return $this->hasMany('App\Models\Category', 'category_id')->with('categories');
    }


    public function parentCategory() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function getRootCategoryAttribute() {
        if(!$this->parentCategory)
            return $this;
        return $this->parentCategory->root_category;
    }

}
