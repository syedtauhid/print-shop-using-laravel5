<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReferalLinks extends Model
{
    //
    protected $table = 'referal_links';

    protected $fillable  = [
        'user_id','refered_name','email','referal_code'
    ];

}
