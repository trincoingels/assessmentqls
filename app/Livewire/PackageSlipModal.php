<?php

namespace App\Livewire;

use App\Services\LabelService;
use App\Services\OrderService;
use App\Services\PackageSlipService;
use App\Services\ProductService;
use App\Services\ShipmentService;
use LivewireUI\Modal\ModalComponent;
use PhpParser\Node\Stmt\Label;

class PackageSlipModal extends ModalComponent
{
    public $weight;
    public $order_number;
    public $shippingMethod;

    public $shippingMethods = [];

    protected $rules = [
        'weight' => 'required|int',
        'shippingMethod' => 'required|int',
        'order_number' => 'required|int',
    ];

    public function mount()
    {
        $this->filterShippingMethods();
    }

    /*
     * Filter shipping methods based on weight
     */
    public function filterShippingMethods()
    {

        $productService = new ProductService();
        $products = $productService->getProducts();

        $this->shippingMethods = array_filter($products, function ($method) {
            $weight = $this->weight * 1000;
            foreach ($method['pricing'] as $pricing) {
                if ($weight >= $pricing['weight_min'] && $weight <= $pricing['weight_max']) {
                    return true;

                }
            }
            return false;
        });
    }

    public function updatedWeight()
    {
      $this->filterShippingMethods();
    }

    /*
     * Download package slip
     */
    public function download()
    {
        $this->validate();

        $order = (new OrderService())->getOrder();

        $shipmentService = new ShipmentService($order);
        $response = $shipmentService->createShipment($this->shippingMethod);
        (new LabelService($order->id))->saveLabel($response['data']['label_pdf_url']);

        $packageSlipService = new PackageSlipService($order);

        $this->dispatch('packingSlipPrinted');
        $this->dispatch('closeModal');

        return $packageSlipService->download();

    }

    public function render()
    {
        return view('livewire.package-slip-modal');
    }
}
