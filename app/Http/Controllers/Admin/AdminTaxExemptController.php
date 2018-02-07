<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/6/2017
 * Time: 12:28 PM
 */

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Model\TaxExempt;
use Illuminate\Http\Request;
use Mockery\Exception;
use Psy\Exception\ErrorException;

class AdminTaxExemptController extends Controller
{
    public function getFormUpload(){
        return view('admin.tax-exempt.form-upload');
    }

    public function postFormUpload(Request $request){
        $file = $request->file('taxExemptForm');
        try{
            Helper::storeFile('image/tax-exempt/',$file,'tax-exempt-form',false);
            return redirect()->route('admin.tax-exempt')->with('success','Tax exempt form uploaded successfully');
        }catch(ErrorException $e){
            return $e;
        }
    }
    
    public function pendingForms(){
        $data = $this->getFormsByStatus('pending');
        $status = "pending";
        return view('admin.tax-exempt.uploaded-form',compact('status','data'));
    }
    
    public function acceptedForms(){
        $data = $this->getFormsByStatus('accepted');
        $status = "accepted";
        return view('admin.tax-exempt.uploaded-form',compact('status','data'));
    }

    public function changeStatus($taxExemptId,$status){
        $taxExempt = TaxExempt::find($taxExemptId);
        $taxExempt->status = $status;
        $taxExempt->save();
        return redirect()->back();
    }

    private function getFormsByStatus($status)
    {
        $data = TaxExempt::with('user')->where('status',$status)->orderBy('created_at','desc')->get();
        return $data;
    }
}