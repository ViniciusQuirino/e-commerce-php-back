<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Services\Users\CreateUserService;
use App\Services\Users\DeleteUserService;
use App\Services\Users\RetrieveUserService;
use App\Services\Users\UpdateUserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function createUser(CreateUserRequest $request)
    {
        $createUserService = new CreateUserService();
        $result = $createUserService->execute($request->all());
        return response()->json($result, 201);
    }

    public function retrieveUser(Request $request, $id)
    {
        $retrieveUserService = new RetrieveUserService();
        $result = $retrieveUserService->execute($id);
        return response()->json($result, 200);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $updateUserService = new UpdateUserService();
        
        $validatedData = $request->validated();

        $token = $request->bearerToken();
        $jwtToken = new \Tymon\JWTAuth\Token($token);
        $payload = JWTAuth::decode($jwtToken);
        $userId = $payload['id'];

        $result = $updateUserService->execute($validatedData, $userId);
        return response()->json($result, 201);
    }

    public function deleteUser(Request $request)
    {
        $retrieveUserService = new DeleteUserService();

        $token = $request->bearerToken();
        $jwtToken = new \Tymon\JWTAuth\Token($token);
        $payload = JWTAuth::decode($jwtToken);
        $userId = $payload['id'];

        $retrieveUserService->delete($userId);

        return response()->json([], 204);
    }
    
}
