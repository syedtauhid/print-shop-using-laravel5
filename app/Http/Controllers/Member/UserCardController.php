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
use App\Model\UserCard;
use App\Model\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\CutArrayStub;

class UserCardController extends Controller
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
     $userCards = $this->getCardInfos();

     return view('user.card-information',compact('userCards'));
    }

    public function store(Request $request){
        $input = $request->all();
        $input['user_id'] = Auth::id();
        if(isset($input['default'])){
            UserCard::where('user_id',Auth::id())->update(['default'=>0]);
        }else{
            $input['default']=0;
        }
        UserCard::create($input);
        return redirect()->back();
    }

    public function update($id,Request $request){
        $input = $request->except('_token');
        if(!$request->has('default')){
            $input['default'] = 0;
        }
        UserCard::where('id',$id)->update($input);
        if($input['default']){
            UserCard::where('id','!=',$id)->where('user_id',Auth::id())->update(['default'=>0]);
        }
        return redirect()->back();
    }
    public function delete(Request $request){
        $id = $request->except('_token');
        //dd($id);
        UserCard::where('id',$id)->delete();
        return redirect()->back()->with("status", "Successfully Delete!");
    }

    private function getCardInfos(){
        $data = UserCard::where('user_id',Auth::id())->get();
        return $data;
    }

}