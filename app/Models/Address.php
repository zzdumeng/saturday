<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use \Backpack\CRUD\CrudTrait;
    //
    public function addressable() {
        return $this->morphTo();
    }

    public function province() {
        return $this->belongsTo('App\Models\Province');
    }
    public function region() {
        return $this->belongsTo('App\Models\Region');
    }
    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
