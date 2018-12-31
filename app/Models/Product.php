<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * NOTE:
 * How to store the category and product?
 * 1, at first we only add a relation between product and the most low-level
 *  category in the `category_product` table.
 *  But that would cause query the products from a parent level category be 
 *  much difficult.
 * 2, now assume we have a category tree:
 *      - meat
 *          - beaf
 *              - australia
 *              - newzealand
 *  and when to save a product under `australia` category, we create 3 records
 *  in the `category_product` table instead of 1.
 *  By this, we can efficiently query product under any category. 
 */
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


    public function getRootCategoryAttribute() {
        return $this->categories[0]->root_category;
    }

    public function getPagedReviewsAttribute() {
        return $this->reviews()->with('user')->paginate(10);
    }
}
