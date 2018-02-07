<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryPress extends Model
{
    protected $table = 'category_press';
    protected $fillable = ['category_id','label','placeholder','field_type','values'];
}
