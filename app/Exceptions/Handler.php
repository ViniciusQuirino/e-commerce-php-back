<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler

{
    protected $dontFlash = [
        'current_password',
        'passwords',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $error)
    {
        //Enviar erro no slack
        Log::debug('Internal', [$error]);

        //Erro da validação PATH=Request
        if ($error instanceof ValidationException) {
            return response()->json([
                'errors' => $error->validator->errors()
            ], 422);
        }

        //Error AppError ?
        if ($error instanceof AppError) {
            return response()->json([
                'errors' => $error->getMessage()
            ], $error->getCode());
        }

        //tratando erro do "authorize" da Request -> validação de dados
        if ($error instanceof AuthorizationException) {
            return response()->json([
                'errors' => 'Usuário não autorizado'
            ], 403);
        }

        //Tratando erro de rota não encontrada
        if ($error instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => "Rota não encontrada."
            ], 404);
        }

        //Error não previsto
        return response()->json([
            'message' => 'Ocorreu um erro interno no servidor'
        ], 500);
    }
}
