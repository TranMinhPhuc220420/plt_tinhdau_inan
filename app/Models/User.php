<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'User_Username',
        'User_Email',
        'User_Password',
        'User_FullName',
        'User_IsAdmin',
        'User_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'User_Password',
//        'User_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toArray()
    {
        return [
            'PkUser_id' => $this->PkUser_id,
            'User_Password' => $this->User_Password,
            'User_Token' => $this->User_token
        ];
    }

    static public function checkToken($token)
    {
        return User::where('User_token', $token)->get()->first() != null;
    }
}
