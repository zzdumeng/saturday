<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public function regions() {
        return $this->hasMany('App\Models\Region');
    }
}
