<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/3/2017
 * Time: 9:15 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class OrderShipInfo extends Model
{
    protected $table = 'order_shipinfos';
    protected $fillable = ['order_id','first_name', 'last_name',
                            'address','city','state','zipcode','country','mobile'];
}