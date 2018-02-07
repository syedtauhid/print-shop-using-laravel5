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
use App\Model\ReferalLinks;
use App\Model\ReferalRelationship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class UserReferalController extends Controller{

  private function generateReferalCode(){
      // generate random code here
      $random_string = md5(microtime());
      return $random_string;
  }

  private function sendMail(){

  }

  public function sendReferalCode(Request $request){

      //validation rules set

      $rules = array(
          'refered_name'             => 'required',                        // just a normal required validation
          'email'            => 'required|email|unique:referal_links',     // required and must be unique in the ducks table
      );
      // validate against the inputs from our form

      $validator = Validator::make($request->all(), $rules);
      // check if the validator failed -----------------------
      if ($validator->fails()) {

          // get the error messages from the validator
          //$messages = $validator->messages();

          // redirect our user back to the form with the errors from the validator
          return redirect()->back()
                          ->withErrors($validator)->withInput();
      } else {
          $referal_code = $this->generateReferalCode();

          // save data
          $input = $request->all();
          //dd($input);
          $input['user_id'] = Auth::id();
          $input['referal_code'] = $referal_code;

          //save message for email
          $msq = $input['message'];
          unset($input['message']);

          // @todo:mail creating url like localhost:8000/register? refer= $ referal_code

          // call mail function
          //$this->sendMail();

          ReferalLinks::create($input);
          return redirect()->back()->with('success','Invitation sent Successfully');
      }
  }

  public function storeUserInReferalRelation($userId){
       $input['refered_user_id'] = $userId;
       $input['user_id'] = session()->pull('ref-user');
       //dd($input);
       ReferalRelationship::create($input);

  }

}