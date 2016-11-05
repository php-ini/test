<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'product';
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_name', 'qty', 'price'];
}
