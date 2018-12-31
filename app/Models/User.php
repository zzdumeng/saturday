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

    public function orders() {
        return $this->hasMany('App\Models\Order')->with('items')->paginate(10);
    }
    public function messages() {
        return $this->hasMany('App\Models\Message')->paginate(10);
    }
    public function footprints() {
        return $this->hasMany('App\Models\Footprint')->with('product')->paginate(10);
    }
    public function bills() {
        return $this->hasMany('App\Models\Bill')->with('billtype')->paginate(10);
    }
}

