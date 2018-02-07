<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryPriceMap extends Model
{
    protected $table = 'category_price_map';
    protected $fillable = ['category_id','price','quantity'];
}
