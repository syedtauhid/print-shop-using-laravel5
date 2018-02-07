<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use Illuminate\Http\Request;
use Mockery\Exception;
use Psy\Exception\ErrorException;

class AdminCategoryController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display category tree.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->categoryRepo->getCategoryTree();
        $categories = empty($data)?null:$data;
	
         return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->getParentCategoryList();
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $response = $this->categoryRepo->store($request);
            if($response){
                return redirect()->route('admin.category.index')->with('success','Category added successfully');
            }
            return redirect()->back()->withErrors(['Something went wrong'])->withInput();
        }catch(ErrorException $e){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->categoryRepo->getUploadInfo($id);
        return view('admin.category.category-upload',compact('data','id'));
    }

    public function getUploadInfoJson($id){
        $data= $this->categoryRepo->getUploadInfoByCategoryId($id);
        return response()->json($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->categoryRepo->destroy($id);
            return redirect()->back()->with('success','Category deleted successfully');
        }catch (Exception $e){
            return $e;
        }
    }

    public function getUploadInfo($id){
        $data = $this->categoryRepo->getUploadInfo($id);
        return view('admin.category.category-upload',compact('data','id'));
    }

    public function postUploadInfo($id,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        $this->categoryRepo->postUploadInfo($id,$data);
        return redirect()->back()->with('success','Category upload info added successfully');
    }

    public function updateUploadInfo($categoryId,$uploadInfoId,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        if(in_array($data['field_type'],['text','number','file'])){
            $data['values']=[];
        }
        $this->categoryRepo->updateUploadInfo($uploadInfoId,$data);
        return redirect()->back()->with('success','Category upload info updated successfully');
    }

    public function deleteUploadInfo($id){
        $this->categoryRepo->deleteUploadInfo($id);
        return redirect()->back();
    }

    public function getPrintInfo($id){
        $data = $this->categoryRepo->getPrintInfo($id);
        return view('admin.category.category-print',compact('data','id'));
    }

    public function postPrintInfo($id,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        $this->categoryRepo->postPrintInfo($id,$data);
        return redirect()->back()->with('success','Category upload info added successfully');
    }

    public function updatePrintInfo($categoryId,$printInfoId,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        if(in_array($data['field_type'],['text','number','file'])){
            $data['values']=[];
        }
        $this->categoryRepo->updatePrintInfo($printInfoId,$data);
        return redirect()->back()->with('success','Category upload info added successfully');
    }

    public function deletePrintInfo($id){
        $this->categoryRepo->deletePrintInfo($id);
        return redirect()->back();
    }

    public function getPressInfo($id){
        $data = $this->categoryRepo->getPressInfo($id);
        $priceDepedencyList = $this->categoryRepo->getCategoryPriceDependencyListByCategoryId($id);
        return view('admin.category.category-press',compact('data','id','priceDepedencyList'));
    }

    public function postPressInfo($id,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        $this->categoryRepo->postPressInfo($id,$data);
        return redirect()->back()->with('success','Category upload info added successfully');
    }

    public function updatePressInfo($categoryId,$pressInfoId,Request $request){
        $data = $request->all();
        if(!empty($data['values'])){
            $data['values'] = array_diff($data['values'],[""]);
        }
        if(in_array($data['field_type'],['text','number','file'])){
            $data['values']=[];
        }
        $this->categoryRepo->updatePressInfo($pressInfoId,$data);
        return redirect()->back()->with('success','Category upload info added successfully');
    }

    public function deletePressInfo($id){
        $this->categoryRepo->deletePressInfo($id);
        return redirect()->back();
    }

    public function getPriceMap($id){
        $categoryDetails = $this->categoryRepo->getCategoryDetailsById($id);
        return view('admin.category.price-map',compact('categoryDetails','id'));
    }

    public function storePriceMap($id,Request $request){
        $this->categoryRepo->storePriceMap($id,$request->except('_token'));
        return redirect()->back();
    }

    public function deletePriceMap($id){
        $this->categoryRepo->deletePriceMap($id);
        return redirect()->back();
    }

    public function postPriceMapDependency($id,Request $request){
        $this->categoryRepo->storeCategoryPriceDeendency($id,$request->all());
        $this->categoryRepo->deletePriceMapByCategoryId($id);
        return redirect()->back();
    }

    public function getSpecialCategories(){
        $data = $this->categoryRepo->getSpecialCategories();
        return view('admin.special-category.index',compact('data'));
    }

    public function createSpecialCategories(){
        $categories = $this->categoryRepo->getAvailableCategoriesToBeSpecialCategory();
        return view('admin.special-category.create',compact('categories'));
    }

    public function storeSpecialCategories(Request $request){
        try{
            $response = $this->categoryRepo->storeSpecialCategory($request->all());
            if($response){
                return redirect()->route('admin.special.category.index')->with('success','Special category added successfully');
            }
            return redirect()->back()->withErrors(['Something went wrong'])->withInput();
        }catch(ErrorException $e){
            return $e;
        }
    }

    public function deleteSpecialCategories($id){
        try{
            $this->categoryRepo->destroySpecialCategory($id);
            return redirect()->back()->with('success','Special Category deleted successfully');
        }catch (Exception $e){
            return $e;
        }
    }

    public function toggleSpecialCategoryStatus($id){
        try{
            $this->categoryRepo->toggleSpecialCategoryStatus($id);
            return redirect()->back();
        }catch (Exception $e){
            return $e;
        }
    }
}
