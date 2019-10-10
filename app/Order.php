<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="tb_users";
    protected $fillable = [
        'name', 'gender','email','password','email','description'
    ];
}
