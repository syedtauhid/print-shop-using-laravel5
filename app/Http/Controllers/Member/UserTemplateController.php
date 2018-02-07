<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use App\Repo\TemplateRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserTemplateController extends Controller
{
    /**
     * @var TemplateRepo
     */
    private $templateRepo;
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(TemplateRepo $templateRepo,CategoryRepo $categoryRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $categoryDetail = $this->categoryRepo->getCategoryDetailsById($id);
        $templates = $this->templateRepo->getTemplateByCategoryId($id);
        //dd($templates);
        //dd($categoryDetail);
        return view('user.productTemplate.template',compact('categoryDetail','templates'));
    }

    public function storeUserTemplateInfo($categoryId,Request $request){
        $userTemplateInfo = [];
        $template['category_id'] = $categoryId;
        $files = $request->allFiles();
        foreach ($files as $key=>$item){
            $itemName = $this->storeImage($item);
            $userTemplateInfo[$key] = $itemName;
        }
        $data = $request->except(array_keys($userTemplateInfo));
        unset($data['_token']);
        $userTemplateInfo = array_merge($userTemplateInfo,$data);
        $template['template_info'] = $userTemplateInfo;
        session()->put('template',json_encode($template));
        return redirect()->route('print.info');
    }

    public function storeSelectedTemplateId($categoryId,$templateId){
        $template = [];
        $temp_info = [];
        $template['category_id'] = $categoryId;
        $template['template_id'] = $templateId;
        $temp = $this->templateRepo->getTemplateDetailsObjById($templateId);
        $temp_info['info'] = !empty($temp->templateInfo)?$temp->templateInfo->template_info:'';
        $temp_info['name'] = $temp->name;
        $temp_info['image'] = $temp->image;
        $template['template_info'] = $temp_info;
        session()->put('template',json_encode($template));
        return redirect()->route('print.info');
    }

    private function storeImage($image){
        $rand = Carbon::now()->timestamp;
        $path = '/image/template/user/';
        $imageName = $image->getClientOriginalName().'_'.$rand.'.'.$image->getClientOriginalExtension();
        $image->move(public_path($path),$imageName);
        return $path.$imageName;
    }

}
