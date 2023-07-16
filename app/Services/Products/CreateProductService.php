<?php

namespace App\Services\Products;

use App\Exceptions\AppError;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CreateProductService
{
    public function execute(array $data, string $userId)
    {
        $name = Product::firstWhere('name', $data['name']);

        if (is_null($name)) {
            $product = Product::create([
                "name" => $data['name'],
                "description" => $data['description'],
                "voltage" => $data['voltage'],
                "brand" => $data['brand'],
                "price" => $data['price'],
                "image" => $data['image'],
                'user_id' => $userId,
            ]);

            return $product;
        } else {
            throw new AppError("Já existe um produto com esse nome", 409);
        }
    }
}
