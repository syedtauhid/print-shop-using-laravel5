<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryPriceDependency extends Model
{
    protected $table = 'category_price_dependency';
    protected $fillable = ['category_id','category_press_id'];
    public function categoryPress(){
        return $this->belongsTo('App\Model\CategoryPress','category_press_id');
    }
}
