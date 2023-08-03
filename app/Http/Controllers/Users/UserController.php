<?php

namespace App\Http\Controllers\Users;

use App\Exceptions\AppError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Users\CreateUserService;
use App\Services\Users\DeleteUserService;
use App\Services\Users\ResetPasswordService;
use App\Services\Users\RetrieveUserService;
use App\Services\Users\SendEmailPasswordService;
use App\Services\Users\UpdateUserService;
use App\Services\Users\VerifyEmailService;
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

    public function verifyEmail($token)
    {
        $verifyEmailService = new VerifyEmailService();
        $result = $verifyEmailService->execute($token);
        return response()->json($result, 200);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);
        $sendEmailPasswordService = new SendEmailPasswordService();
        $result = $sendEmailPasswordService->execute($validatedData);
        return response()->json($result, 200);
    }

    public function reset(Request $request, $token)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'confirmPassword' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', 'same:password'],
        ]);
        $resetPasswordService = new ResetPasswordService();
        $result = $resetPasswordService->execute($validatedData, $token);
        return response()->json($result, 201);
    }

    public function retrieveUser(Request $request)
    {
        $retrieveUserService = new RetrieveUserService();

        $token = $request->bearerToken();
        $jwtToken = new \Tymon\JWTAuth\Token($token);
        $payload = JWTAuth::decode($jwtToken);
        $userId = $payload['id'];

        $result = $retrieveUserService->execute($userId);
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
