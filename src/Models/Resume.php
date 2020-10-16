<?php


namespace AYakovlev\Models;


use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';
    protected $fillable = [
        'vacancy_id',
        'position',
        'firstname',
        'secondname',
        'lastname',
        'birthdate',
        'address_fact',
        'address_registration',
        'phone',
        'email',
        'family_status',
        'education',
        'experience',
        'about',
    ];
    public $timestamps = true;
}
