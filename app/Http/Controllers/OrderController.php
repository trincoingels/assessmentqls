<?php

namespace App\Http\Controllers;

use App\Services\LabelService;
use App\Services\OrderService;
use App\Services\PackageSlipService;
use App\Services\ProductService;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $orderService;

    public function __construct()
    {
        if(is_null($this->orderService))
            $this->orderService = new OrderService();
    }

    public function show(): view
    {
        return view('order', [
            'order' => $this->orderService->getOrder()
        ]);
    }

    public function label()
    {
        $order = $this->orderService->getOrder();

        $packageSlipService = new PackageSlipService($order);

        return $packageSlipService->download();
    }
}
