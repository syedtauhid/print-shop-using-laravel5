<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/14/2017
 * Time: 8:10 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }
}