<?php

namespace App\Http\ViewComposers;

use App\Repo\OrderRepo;
use Illuminate\View\View;

class OrderCountComposer
{

    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('orderCount',$this->getOrderCount());
    }

    public function getOrderCount(){
        return $this->orderRepo->countOrderByStatus();
    }
}