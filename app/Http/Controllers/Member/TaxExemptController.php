<?php
/**
 * Created by PhpStorm.
 * User: Charlie
 * Date: 3/18/2017
 * Time: 1:16 AM
 */

namespace App\Http\Controllers\Member;


use App\Helper;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\TaxExempt;
use App\Model\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxExemptController extends Controller
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
       $userId = Auth::id();
       $uploadedTaxExemptForms = TaxExempt::where('user_id',$userId)->get();
       return view('user.tax-exempt',compact('uploadedTaxExemptForms'));
  }

  public function store(Request $request){
    $user = auth()->user();
    $form = $request->file('taxExemptForm');
    $formName = Helper::storeFile('/image/tax-exempt/',$form,$user->name);
    TaxExempt::create([
        'user_id'=>$user->id,
        'form'=>$formName
    ]);
     return redirect()->route('user.tax-exempt')->with('success','Tax exempt form uploaded successfully.You will notify shortly');
  }
}