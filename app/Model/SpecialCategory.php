<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/10/2017
 * Time: 2:17 AM
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpecialCategory extends Model
{
    protected $table='special_categories';
    protected $fillable=['category_id','status'];
    
    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }
}