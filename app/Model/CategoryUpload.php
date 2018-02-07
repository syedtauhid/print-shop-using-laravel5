<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryUpload extends Model
{
    protected $table = 'category_upload';
    protected $fillable = ['category_id','label','placeholder','field_type','values'];
}
