<?php
namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function addresses() {
        return $this->morphMany('App\Models\Address', 'addressable');
    }
    public function points() {
        return $this->hasMany('App\Models\Point');
    }
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
    public function cartitems() {
        return $this->hasMany('App\Models\CartItem');
    }
    public function getPagedOrdersAttribute() {
        return $this->orders()->with('items')->paginate(10);
    }
    public function messages() {
        return $this->hasMany('App\Models\Message');
    }
    public function getPagedMessagesAttribute() {
        return $this->hasMany('App\Models\Message')->paginate(10);
    }
    public function getPagedPointsAttribute() {
        return $this->points()->paginate(10);
    }

    public function footprints() {
        return $this->hasMany('App\Models\Footprint')->with('product');
    }
    public function getPagedFootprintsAttribute() {
        return $this->footprints()->paginate(6);
    }
    public function bills() {
        return $this->hasMany('App\Models\Bill')->with('billtype');
    }

    public function getPagedBillsAttriute() {
        return $this->bills()->paginate(10);
    }
    /**
     * user's money can be get from bills
     */
    public function getCurrentMoneyAttribute() {
        $bill = $this->bills()->orderByDesc('created_at')->first();
        if($bill) return $bill->balance;
        return 0;
    }
    public function getCurrentPointsAttribute() {
        $first = $this->points()->orderByDesc('created_at' )->first();
        if($first) {
            return $first->current;
        }
        return 0;
        // return 3;
    }

}

