<?php

namespace App\Http\ViewComposers;

use App\Repo\CategoryRepo;
use Illuminate\View\View;

class CategoryComposer
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
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categoryTree',$this->getCategoryTree());
    }

    public function getCategoryTree(){
        return $this->categoryRepo->getCategoryTree();
    }
}