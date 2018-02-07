<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:12 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';
    protected $fillable = ['order_id','name','price','product_info','admin_upload','category_id',
                            'quantity','template_id'];

    public function orderReview(){
        return $this->hasMany(OrderReview::class,'order_product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}