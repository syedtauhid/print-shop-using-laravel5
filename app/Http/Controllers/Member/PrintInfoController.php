<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use App\Repo\TemplateRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrintInfoController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;
    /**
     * @var TemplateRepo
     */
    private $templateRepo;

    public function __construct(CategoryRepo $categoryRepo, TemplateRepo $templateRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->templateRepo = $templateRepo;
    }

    public function index(){
        if (session()->has('template'))
            $template = json_decode(session()->get('template'));
        else
            return redirect('/');

        $categoryDetails = $this->categoryRepo->getCategoryDetailsById($template->category_id);
        return view('user.print-info',compact('template','categoryDetails'));
    }

    public function store(Request $request){
      $files = $request->allFiles();
      foreach ($files as $key=>$item){
          $itemName = $this->storeImage($item);
          $userTemplateInfo[$key] = $itemName;
      }
      if (isset($userTemplateInfo)) {
        $data = $request->except(array_keys($userTemplateInfo));
        $data = array_merge($userTemplateInfo,$data);
      } else {
        $data = $request->all();
      }
      unset($data['_token']);
      $print['print_info'] = $data;
      session()->put('print',json_encode($print));
      return redirect()->route('press.info');
    }

    private function storeImage($image){
        $rand = Carbon::now()->timestamp;
        $path = '/image/template/user/';
        $imageName = $image->getClientOriginalName().'_'.$rand.'.'.$image->getClientOriginalExtension();
        $image->move(public_path($path),$imageName);
        return $path.$imageName;
    }
}
