<?php


namespace AYakovlev\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'nickname',
        'email',
        'is_confirmed',
        'role',
        'password_hash',
        'auth_token',
        'first_name',
        'last_name'
    ];
    public $timestamps = true;
}
