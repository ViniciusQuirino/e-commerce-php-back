<?php

namespace App\Services\Products;
use App\Models\Product;

class ListAllProductsService
{
    public function execute(string $name = null, string $brand = null)
    {
        $query = Product::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($brand) {
            $query->where('category', 'like', "%$brand%");
        }

        $products = $query->get();

        return $products;
    }
}
