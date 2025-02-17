<?php

namespace App\Services;

use App\Traits\HasContactInfo;
use Illuminate\Support\Facades\Http;
use Exception;

class ShipmentService
{
    use HasContactInfo;

    public object $order;

    public function __construct(object $order)
    {
        $this->order = $order;
    }

    public function createShipment(int $productCombinationId)
    {
        try {
            $response = Http::withBasicAuth(
                config('services.qls.username'),
                config('services.qls.password')
            )->post(config('services.qls.host') . '/v2/companies/'.config('services.qls.companyid').'/shipments', $this->createBody($productCombinationId));

            if ($response->failed()) {
                throw new Exception('Fout bij het aanmaken van de zending: ' . $response->body());
            }

            return $response->json();
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function createBody(int $productCombinationId): array
    {

        $order = $this->order;

        return [
            'product_combination_id' => $productCombinationId,
            'brand_id' => config('services.qls.brandid') ,
            'return_contact' => $this->getContactInfo($order->billing_address),
            'sender_contact' => $this->getContactInfo($order->billing_address),
            'receiver_contact' => $this->getContactInfo($order->delivery_address),
            'zpl_direct' => false
        ];
    }
}
