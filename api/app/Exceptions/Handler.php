<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Orenda\JsonResponse;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $jsonResponse = new JsonResponse();
            $jsonResponse->setError(true);

            if ($exception instanceof UnauthorizedHttpException) {
                $jsonResponse->setStatus(401);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof AuthenticationException) {
                $jsonResponse->setStatus(401);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof TokenMismatchException) {
                $jsonResponse->setStatus(401);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof TokenInvalidException) {
                $jsonResponse->setStatus(401);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof ModelNotFoundException) {
                $jsonResponse->setStatus(404);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof NotFoundHttpException) {
                $jsonResponse->setStatus(404);
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof MethodNotAllowedHttpException) {
                $jsonResponse->setTraces($exception->getTrace());
                $jsonResponse->setMessage($exception->getMessage());
            } else if ($exception instanceof ValidationException) {
                $jsonResponse->setStatus(500);
                $jsonResponse->setValidationException($exception);
            } else {
                $jsonResponse->setStatus(500);
                $jsonResponse->setMessage($exception->getMessage());
            }
                
            return $jsonResponse->getResponse();
        }

        return parent::render($request, $exception);
    }
}
