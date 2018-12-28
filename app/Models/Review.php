<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $casts = ['images' => 'array'];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
