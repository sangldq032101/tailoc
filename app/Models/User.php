<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $primaryKey = 'userID';
    public $incrementing = false;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'fullname',
        'password',
        'avatar'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
