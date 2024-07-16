<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Traits\Roleable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'contact_number', 'postcode', 'gender', 'hobbies','state_id','city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
        return $this->hasMany(UserFile::class);
    }

    use Roleable;

    public function authorizePermissions($permissions)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermissions($permissions)) {
                return true;
            }
        }
        return false;
    }

    //state

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    //city

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeAdmin($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        });
    }

    public function user_login(){
        return $this->hasOne(UserLogin::class);
    }

    public function scopeUserLogin($query)
    {
        return $query->whereHas('user_login', function ($query) {
            $query->where('is_login', 1);
        });
    }
}
