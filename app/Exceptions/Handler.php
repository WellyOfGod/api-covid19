<?php

namespace App\Exceptions;

use Illuminate\Auth\{AuthenticationException, Access\AuthorizationException};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response |
     * \Illuminate\Database\Eloquent\ModelNotFoundException |
     * \Illuminate\Validation\ValidationException |
     * \Illuminate\Auth\Access\AuthorizationException |
     * \Illuminate\Auth\AuthenticationException |
     * \Illuminate\Http\Exceptions\ThrottleRequestsException
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Registro não encontrado.'], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json(['message' => 'Dados informado(s) inválido(s).', 'errors' => $exception->validator->getMessageBag()], 422);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => 'Autorização não concedida.'], 403);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json(['message' => 'Você não está autenticado.'], 401);
        }

        if ($exception instanceof ThrottleRequestsException) {
            return response()->json(['message' => 'Muitas requisições, tente mais tarde.'], 429);
        }

        return parent::render($request, $exception);
    }
}
