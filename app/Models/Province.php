<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use \Backpack\CRUD\CrudTrait;
    //
    public function regions() {
        return $this->hasMany('App\Models\Region');
    }
}
