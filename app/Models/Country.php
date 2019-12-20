<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'money_sign',
        'lang',
        'email',
        'phone',
        'address',
        'title',
        'keywords',
        'desc',
        'order_prefix',
        'sms_msg'
    ];

    public function getLogoUrlAttribute($value){
        return $value ? asset('/uploads/admin/'.$value) : '';
    }

    public function getVideoUrlAttribute($value){
        return $value ? asset('/uploads/admin/'.$value) : '';
    }
}
