<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = 'user_infos';

    protected $fillable = [
        'first_name','last_name','company','address','city','state','zip','phone','company_website','corporate_code','user_id','fax'
    ];

}
