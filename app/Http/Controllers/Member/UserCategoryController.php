<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repo\CategoryRepo;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getSubCategoryView($id){
        $subCategoryList = $this->categoryRepo->getChildCategoryByParentId($id);
        $categoryDetail = $this->categoryRepo->getCategoryDetailsById($id);
        //dd($subCategoryList);
        return view('user.sub-category.category',compact('subCategoryList','categoryDetail'));
    }

    public function getCategoryDetailsById($categoryId){
        $data = $this->categoryRepo->getCategoryDetailsById($categoryId);
        return !empty($data)?$data->toArray():null;
    }
}
