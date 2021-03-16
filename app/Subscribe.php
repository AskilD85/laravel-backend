<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['category_id', 'city_id', 'type','author_id'];
}
