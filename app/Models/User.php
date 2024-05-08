<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'UserID';
    protected $fillable = ['UserName', 'Password','FullName','Email','RandomKey'];
    public $timestamps = false;
    const UPDATED_AT = null;
    protected $hidden = ['created_at', 'updated_at'];
 



}
