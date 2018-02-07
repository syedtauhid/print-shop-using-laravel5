<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReferalRelationship extends Model
{
    //
    protected $table = 'referal_relationship';

    protected $fillable  = [
        'user_id','refered_user_id'
    ];

}
