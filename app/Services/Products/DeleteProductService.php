<?php

namespace App\Services\Products;

use App\Exceptions\AppError;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class DeleteProductService
{
    public function execute(string $productId, string $userId)
    {
        $product = Product::firstWhere(['id' => $productId]);

        Log::debug($product);
        if (is_null($product)) {
            throw new AppError("Produto não encontrado", 404);
        } else if ($product->user_id == $userId) {
            $product->delete();
        } else {
            throw new AppError("Vocẽ pode excluir apenas o seu produto.", 403);
        }
    }
}
