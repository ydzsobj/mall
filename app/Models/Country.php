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
}
