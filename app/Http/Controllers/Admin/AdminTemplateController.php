<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/1/2017
 * Time: 9:25 AM
 */

namespace App\Http\Controllers\Admin;


use App\Helper;
use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use App\Repo\TemplateRepo;
use Illuminate\Http\Request;

class AdminTemplateController extends Controller
{
    /**
     * @var TemplateRepo
     */
    private $templateRepo;
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    /**
     * AdminTemplateController constructor.
     * @param TemplateRepo $templateRepo
     */
    public function __construct(TemplateRepo $templateRepo,CategoryRepo $categoryRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(){
        $data = $this->templateRepo->getAllTemplates();
        return view('admin.product.index',compact('data'));
    }

    public function create(){
        return view('admin.product.create');
    }

    public function store(Request $request){
        $uploadedImage = [];
        $files = $request->allFiles();
        foreach ($files as $key=>$item){
            $itemName = Helper::storeFile('/image/template/',$item,$key);
            $uploadedImage[$key] = $itemName;
        }
        $data = $request->except(array_keys($uploadedImage));
        unset($data['_token']);
        $data = array_merge($uploadedImage,$data);
        $this->templateRepo->storeTemplate($data);

        return redirect()->route('admin.template.index')->with('success','Template added successfully');
    }

    public function update(){
        
    }

    public function destroy($id){
        $this->templateRepo->destroy($id);
        return redirect()->back()->with('success','Template deleted');
    }
}