<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:07 PM
 */

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['job_number','user_id','price','tax','shipping_cost',
                            'discount','extra_charge','total','paid','status','order_shipping_method_id'];

    public function orderProduct(){
        return $this->hasOne(OrderProduct::class,'order_id');
    }
    
    public function orderLogs(){
        return $this->hasMany(OrderLog::class,'order_id');
    }
    
    public function orderShipInfo(){
        return $this->hasOne(OrderShipInfo::class,'order_id');
    }

    public function orderShippingMethod(){
        return $this->belongsTo(OrderShippingMethod::class,'order_shipping_method_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}