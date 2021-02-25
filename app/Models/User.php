<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'username', 'current_store_id', 'pin', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function stores()
    {
        return $this->hasMany('App\Models\UserJoinStore', 'user_id');
    }

    public function podeAlterarSenha($id)
    {
        if (\Auth::user()->id == $id) {
            return 'true';
        }
        return 'false';
    }

    public function currentStore()
    {
        return $this->belongsTo('App\Models\Store', 'current_store_id');
    }

    public function accesses()
    {
        return $this->hasMany('App\Models\UserAccess', 'user_id');
    }
}
