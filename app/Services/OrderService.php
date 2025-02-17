<?php

namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class OrderService
{

    public function getOrder(): object
    {
        $order = Storage::disk('private')->get('order.json');

        return json_decode($order);
    }
}
