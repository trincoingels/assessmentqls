<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ProductService
{

    public function getProducts(): array
    {
        $products = Storage::disk('private')->get('products.json');

        return json_decode($products, true);
    }
}
