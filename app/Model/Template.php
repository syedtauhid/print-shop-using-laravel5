<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/14/2017
 * Time: 2:20 AM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;

    protected $table = 'templates';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','category_id','category_slug','image'];

    public function templateInfo(){
        return $this->hasOne('App\Model\TemplateInfo','template_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}