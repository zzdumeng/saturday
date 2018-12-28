<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    // protected $table = 'users';
    public function addresses() {
        return $this->morphMany('App\Models\Address', 'addressable');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    public function messages() {
        return $this->hasMany('App\Models\Message');
    }
    public function footprints() {
        return $this->hasMany('App\Models\Footprint');
    }
    public function bills() {
        return $this->hasMany('App\Models\Bill');
    }
}
