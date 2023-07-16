<?php

namespace App\Services\Products;

use App\Exceptions\AppError;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class UpdateProductService
{
    public function execute(array $data, string $productId)
    {

        $product = Product::firstWhere('id', $productId);

        if (is_null($product)) {
            throw new AppError("Produto não encontrado", 404);
        }
        
        if (empty($data['name'])) {
            $product->update($data);
            return $product;
        } else {
            $name = Product::firstWhere("name", $data['name']);

            if (!is_null($name)) {
                throw new AppError("Já existe um produto com esse nome", 409);
            } else {
                $product->update($data);
                return $product;
            }
        }
    }
};
