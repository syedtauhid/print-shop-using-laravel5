<?php namespace App\Repo;

use App\Helper;
use App\Model\Category;
use App\Model\CategoryPress;
use App\Model\CategoryPriceDependency;
use App\Model\CategoryPriceMap;
use App\Model\CategoryPrint;
use App\Model\CategoryUpload;
use App\Model\SpecialCategory;
use App\Model\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryRepo{

    /**
     * @var Category
     */
    private $category;
    /**
     * @var CategoryPress
     */
    private $categoryPress;
    /**
     * @var CategoryUpload
     */
    private $categoryUpload;
    /**
     * @var CategoryPrint
     */
    private $categoryPrint;
    /**
     * @var CategoryPriceDependency
     */
    private $categoryPriceDependency;
    /**
     * @var CategoryPriceMap
     */
    private $categoryPriceMap;
    /**
     * @var SpecialCategory
     */
    private $specialCategory;

    public function __construct(
        Category $category,
        CategoryPress $categoryPress,
        CategoryUpload $categoryUpload,
        CategoryPrint $categoryPrint,
        CategoryPriceDependency $categoryPriceDependency,
        CategoryPriceMap $categoryPriceMap,
        SpecialCategory $specialCategory
    )
    {

        $this->category = $category;
        $this->categoryPress = $categoryPress;
        $this->categoryUpload = $categoryUpload;
        $this->categoryPrint = $categoryPrint;
        $this->categoryPriceDependency = $categoryPriceDependency;
        $this->categoryPriceMap = $categoryPriceMap;
        $this->specialCategory = $specialCategory;
    }

    public function store(Request $request){
        $data = $request->all();
        $imageName = Helper::storeFile('/image/category/',$request->file('image'),$request->get('slug'));
        $data['image'] = $imageName;
        $category = $this->category->create($data);
        if(!$category->parent_id){
            $catPressDefaultData = $this->defaultQuantityDataForPressInfo();
            $catPressDefaultData['category_id'] = $category->id;
            $this->postPressInfo($category->id,$catPressDefaultData);
        }
        return true;
    }

    public function destroy($id){
        $data = $this->category->with('children')->find($id);
        $templateCategoryId = [];
        if($data->children->count()>0){
            $templateCategoryId = $data->children->pluck('id')->toArray();
        }else{
            $templateCategoryId = [$id];
        }
        $data->delete();
        $this->deleteSpecialCategoryByCategoryId($id);
        $this->deleteTemplatesByCategoryId($templateCategoryId);
        return true;
    }

    private function deleteSpecialCategoryByCategoryId($id){
        $this->specialCategory->where('category_id',$id)->delete();
    }

    private function deleteTemplatesByCategoryId($id){
        Template::whereIn('category_id',$id)->delete();
    }

    public function getCategoryTree(){
        $data = Category::with('children')->where('parent_id',0)->get();
        return $data;
    }

    public function getParentCategoryList(){
        $data = Category::where('parent_id',0)->pluck('name','id');
        return $data;
    }

    public function postUploadInfo($id,$data){
        $data['values'] = json_encode($data['values']);
        $data['category_id'] = $id;
        $this->categoryUpload->create($data);
        return true;
    }

    public function updateUploadInfo($uploadInfoId,$data){
        $uploadInfo = $this->categoryUpload->where('id',$uploadInfoId)->first();
        $uploadInfo->label = $data['label'];
        $uploadInfo->field_type = $data['field_type'];
        $uploadInfo->placeholder = $data['placeholder'];
        $uploadInfo->values = json_encode($data['values']);
        $uploadInfo->save();
    }

    public function getUploadInfo($id){
        $data = $this->categoryUpload->where('category_id',$id)->get();
        return $data;
    }

    public function getUploadInfoByCategoryId($id){
        $category = $this->category->where('id',$id)->first();
        $categoryId = $category->parent_id?$category->parent_id:$id;
        $categoryUpload = $this->categoryUpload->where('category_id',$categoryId)->get();
        return $categoryUpload;
    }

    public function deleteUploadInfo($id){
        $this->categoryUpload->destroy($id);
    }

    public function postPrintInfo($id,$data){
        $data['values'] = json_encode($data['values']);
        $data['category_id'] = $id;
        $this->categoryPrint->create($data);
        return true;
    }

    public function updatePrintInfo($printInfoId,$data){
        $printInfo = $this->categoryPrint->where('id',$printInfoId)->first();
        $printInfo->label = $data['label'];
        $printInfo->field_type = $data['field_type'];
        $printInfo->placeholder = $data['placeholder'];
        $printInfo->values = json_encode($data['values']);
        $printInfo->save();
    }

    public function getPrintInfo($id){
        $data = $this->categoryPrint->where('category_id',$id)->get();
        return $data;
    }

    public function deletePrintInfo($id){
        $this->categoryPrint->destroy($id);
    }


    public function postPressInfo($id,$data){
        $data['values'] = json_encode($data['values']);
        $data['category_id'] = $id;
        $this->categoryPress->create($data);
        return true;
    }

    public function updatePressInfo($pressInfoId,$data){
        $pressInfo = $this->categoryPress->where('id',$pressInfoId)->first();
        $pressInfo->label = $data['label'];
        $pressInfo->field_type = $data['field_type'];
        $pressInfo->placeholder = $data['placeholder'];
        $pressInfo->values = json_encode($data['values']);
        $pressInfo->save();
    }

    public function getPressInfo($id){
        $data = $this->categoryPress->where('category_id',$id)->get();
        return $data;
    }

    public function deletePressInfo($id){
        $data = $this->categoryPress->find($id);
        $checkIfExistInDependency = $this->categoryPriceDependency->where('category_press_id',$id)->first();
        if($checkIfExistInDependency){
            $checkIfExistInDependency->delete();
            $this->deletePriceMapByCategoryId($data->category_id);
        }
        $data->delete();
    }

    public function getSpecialCategories(){
        return $this->specialCategory
                    ->with(['category','category.children'])
                    ->get();

    }

    private function getAllSpecialCategoryList(){
        return $this->specialCategory->pluck('category_id');
    }

    public function getAvailableCategoriesToBeSpecialCategory(){
        return Category::where('parent_id',0)
            ->whereNotIn('id',$this->getAllSpecialCategoryList())
            ->pluck('name','id');
    }

    public function getChildCategoriesByParentSlug($slug){
        return $this->category
                    ->whereIn('parent_id',[DB::raw("select id from categories where slug='$slug'")])
                    ->get();
    }

    public function getChildCategoryByParentId($id){
        return $this->category
            ->where('parent_id',$id)
            ->get();
    }
    
    public function getCategoryDetailsById($categoryId){
        $data = $this->category
                    ->find($categoryId);
        if($data->parent_id){
            $data = $data->load(['parent.categoryPress','parent.categoryPriceDependency','parent.categoryPriceDependency.categoryPress','parent.categoryPriceMap',
                'parent.categoryPrint','parent.categoryUpload']);
        }else{
            $data = $data->load(['categoryPress','categoryPriceDependency','categoryPriceDependency.categoryPress','categoryPriceMap',
                'categoryPrint','categoryUpload']);
        }
        return $data;
    }

    public function storeSpecialCategory($data){
        return $this->specialCategory->create($data);
    }
    public function destroySpecialCategory($id){
        $data = $this->specialCategory->find($id);
        $data->delete();
        return true;
    }
    public function toggleSpecialCategoryStatus($id){
        $data = $this->specialCategory->find($id);
        if($data->status){
            $data->status=0;
        }else{
            $data->status=1;
        }
        $data->save();
        return true;
    }
    public function storeCategoryPriceDeendency($categoryId,$input){
        if(!empty($input['category_press_id'])){
            $newDependency = $input['category_press_id'];
        }else{
            $newDependency = [];
        }
        $currentDependency = $this->categoryPriceDependency->where('category_id',$categoryId)->get();
        $currentDependency = $currentDependency?$currentDependency->pluck('category_press_id')->toArray():[];
        $tempNewDependency = array_diff($newDependency,$currentDependency);
        $tempOldDependency = array_diff($currentDependency,$newDependency);

        foreach ($tempNewDependency as $item){
            $this->categoryPriceDependency->create(['category_id'=>$categoryId,
                                                    'category_press_id'=>$item]);
        }
        foreach ($tempOldDependency as $item){
            $this->categoryPriceDependency->where('category_press_id',$item)->delete();
        }
    }

    public function storePriceMap($id,$input){
        $this->categoryPriceMap->category_id = $id;
        $this->categoryPriceMap->quantity = $input['Quantity'];
        $this->categoryPriceMap->price = json_encode($input);
        $this->categoryPriceMap->save();
    }

    public function deletePriceMap($id){
        $this->categoryPriceMap->destroy($id);
    }

    public function deletePriceMapByCategoryId($id){
        $this->categoryPriceMap->where('category_id',$id)->delete();
    }

    private function defaultQuantityDataForPressInfo(){
        $data['field_type'] = 'select';
        $data['placeholder'] = 'Quantity';
        $data['label'] ='Quantity';
        $data['values'] = [1];
        return $data;
    }

    public function getCategoryPriceDependencyListByCategoryId($id){
        $cat = $this->category->find($id);
        return $cat->categoryPriceDependency()->pluck('category_press_id')->toArray();
    }

}