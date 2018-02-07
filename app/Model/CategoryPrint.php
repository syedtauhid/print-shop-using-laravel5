<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryPrint extends Model
{
    protected $table = 'category_print';
    protected $fillable = ['category_id','label','placeholder','field_type','values'];
}
