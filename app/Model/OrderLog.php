<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:28 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $table = 'order_logs';
    protected $fillable  = ['order_id','status','user_id','order_product_id'];
}