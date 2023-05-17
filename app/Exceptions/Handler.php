<?php

namespace App\Exceptions;

use App\Traits\ResponseSender;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseSender;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception): \Symfony\Component\HttpFoundation\Response
    {
        $isApiReq = explode('/', $request->getPathInfo())[1] == 'api';
        if ($request->ajax() || $isApiReq) {
            if ($exception instanceof HttpException) {
                $message = $exception->getMessage() !== '' ? $exception->getMessage() : 'Route not found';
                $errors = [];
                return $this->sendError($errors, $message, $exception->getStatusCode());
            } elseif ($exception instanceof ModelNotFoundException) {
                $model = explode('\\', $exception->getModel());
                $model = $model[count($model) - 1];
                return $this->sendError([sprintf('No data for %s with ids %s', $model, implode(',', $exception->getIds()))], 'Model not found', 404);
            } elseif ($exception instanceof AuthorizationException) {
            } elseif ($exception instanceof AuthenticationException) {
                return $this->sendError([trans('Unauthorized')], $exception->getMessage(), 401);
            } elseif ($exception instanceof ValidationException) {
                $errors = [];
                foreach ($exception->validator->errors()->getMessages() as $key => $messages) {
                    $keys = explode('.', $key, 2);
                    if (count($keys) == 2) {
                        [$index, $field] = $keys;
                        $errors[$index] ??= ['index' => $index, 'keys' => []];
                        $errors[$index]['keys'][] = [$field => $messages];
                    }
                }
                $errors = array_values($errors);

                $message = 'The specified data is invalid.';
                $errArr = [];
                foreach ($exception->validator->errors()->getMessages() as $error) {
                    $errArr[] = $error[0];
                }

                return $this->sendError($errArr, $message, 422, $errors);
            }
        }

        return parent::render($request, $exception);
    }
}
