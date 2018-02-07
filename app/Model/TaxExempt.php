<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/6/2017
 * Time: 3:18 PM
 */

namespace App\Model;


use App\User;
use Illuminate\Database\Eloquent\Model;

class TaxExempt extends Model
{
    protected $table = 'taxexempts';
    protected $fillable = ['user_id','form','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}