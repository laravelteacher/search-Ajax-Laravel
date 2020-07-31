<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class moneyuser extends Model
{
    protected $fillable = [
        'name','email', 'type','amount','category', 'mode','note','date'
    ];
}
