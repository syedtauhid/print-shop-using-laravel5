<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:26 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    protected $table = 'order_reviews';
    protected $fillable = ['order_id','order_product_id','review','updated'];
    
    
}