<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/31/2017
 * Time: 3:38 AM
 */

namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Helper
{
    public static function storeFile($path,$file,$title,$timestamp=true){
        $rand = Carbon::now()->timestamp;
        if (!File::exists($path)) {
            //mkdir($path, 0775, true);
            File::makeDirectory($path, $mode = 0775, true, true);
        }
        $fileName = trim($title);
        if ($timestamp){
            $fileName = $fileName.'_'.$rand;
        }
        $fileName = $fileName.'.'.$file->getClientOriginalExtension();
        $file->move(public_path($path),$fileName);
        return $path.$fileName;
    }

    public static function checkImage($name){
        $extension = explode('.',$name);
        $validImageExtension = ['jpeg','jpg','png','bmp','gif','svg'];
        if(in_array(strtolower(end($extension)),$validImageExtension)){
            return true;
        }
        return false;
    }
}