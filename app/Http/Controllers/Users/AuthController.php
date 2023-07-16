<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\LoginRequest;
use App\Services\Users\LoginService;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        $login = new LoginService();

        return $login->execute($request->all());
    }
}
