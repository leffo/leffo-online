<?php


namespace AYakovlev\Models;


use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';
    protected $fillable =  [
        'title',
        'price',
        'organization',
        'address',
        'telephone',
        'experience',
        'technology',
        'skills',
        'descriptions',
        'category',
    ];
    public $timestamps = true;
}
