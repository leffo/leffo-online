<?php


namespace AYakovlev\Models;


use Illuminate\Database\Eloquent\Model;

class User_activation_code extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'users_activation_codes';

    /**
     * @var string[] $fillable
     */
    protected $fillable =  [
        'user_id',
        'code',
    ];

    /**
     * @var bool $timestamps
     */
    public $timestamps = true;
}
