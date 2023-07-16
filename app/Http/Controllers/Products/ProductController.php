<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Products\CreateProductService;
use App\Services\Products\DeleteProductService;
use App\Services\Products\ListAllProductsService;
use App\Services\Products\UpdateProductService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $createUserService = new CreateProductService();

        $token = $request->bearerToken();
        $jwtToken = new \Tymon\JWTAuth\Token($token);
        $payload = JWTAuth::decode($jwtToken);
        $userId = $payload['id'];

        $result = $createUserService->execute($request->all(), $userId);
        return response()->json($result, 201);
    }

    public function updateProduct(UpdateProductRequest $request, $id)
    {
        $updateProductService = new UpdateProductService();

        $result = $updateProductService->execute($request->all(), $id);
        return response()->json($result, 201);
    }

    public function listAllProduct(Request $request)
    {

        $name = $request->query('name');
        $brand = $request->query('brand');

        $listAllProductsService = new ListAllProductsService();

        $result = $listAllProductsService->execute($name, $brand);
        return response()->json($result, 200);
    }

    public function deleteProduct(Request $request, $id)
    {
        $deleteProductService = new DeleteProductService();

        $token = $request->bearerToken();
        $jwtToken = new \Tymon\JWTAuth\Token($token);
        $payload = JWTAuth::decode($jwtToken);
        $userId = $payload['id'];

        $deleteProductService->execute($id, $userId);
        
        return response()->json([], 204);
    }
}
