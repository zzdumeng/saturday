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
}
