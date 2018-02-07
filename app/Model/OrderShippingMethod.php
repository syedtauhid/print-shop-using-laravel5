<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:31 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderShippingMethod extends Model
{
    protected $table = 'order_shipping_method';
    protected $fillable = ['method'];
}