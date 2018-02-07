<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','image','parent_id'];

    public function parent()
    {
        return $this->belongsTo('App\Model\Category','parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Category','parent_id');
    }

    public function delete()
    {
        $this->children()->delete();

        return parent::delete();
    }

    public function categoryPress(){
        return $this->hasMany('App\Model\CategoryPress','category_id','id');
    }

    public function categoryPriceDependency(){
        return $this->hasMany('App\Model\CategoryPriceDependency','category_id','id');
    }

    public function categoryPriceMap(){
        return $this->hasMany('App\Model\CategoryPriceMap','category_id')->orderBy('quantity');
    }
    
    public function categoryPrint(){
        return $this->hasMany('App\Model\CategoryPrint','category_id');
    }

    public function categoryUpload(){
        return $this->hasMany('App\Model\CategoryUpload','category_id');
    }
}
