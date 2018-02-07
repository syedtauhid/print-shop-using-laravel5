<?php
/**
 * Created by PhpStorm.
 * User: Charlie
 * Date: 3/18/2017
 * Time: 1:16 AM
 */

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Category
     */
    private $category;

    public function __construct(User $user,Category $category)
  {

      $this->user = $user;
      $this->category = $category;
  }

  public function index(){
       $userId = auth()->id();
       $userDetails = User::with('userInfo')->find($userId);
       return view('user.user-information',compact('userDetails'));

  }
  public function updateUserInfo(Request $request){
        $userId = auth()->id();
        $userInfo = $request->all();

        $table_obj = new UserInfo();
        $table_obj->updateOrCreate(['user_id'=>$userId],$userInfo);

        return redirect()->back()->with("status", " Information Saved Successfully.");
    }
}
