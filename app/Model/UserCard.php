<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    //
    protected $table = 'user_cards';

    protected $fillable  = [
        'holder_name','type','account_no','expire_date','user_id','default'
    ];

}
