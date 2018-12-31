<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    // protected $table = 'bill';
    public function billtype() {
        return $this->belongsTo('App\Models\BillType', 'billtype_id');
    }
}
