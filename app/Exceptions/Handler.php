<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Modules\Api\Traits\ApiResponse;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{

    use ApiResponse;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            $message = 'Method is not supported';

            return $this->error($message);
        }

        if ($exception instanceof ValidationException) {
            return $this->returnValidationError($exception);
        }



    }



    private function returnValidationError($exception)
    {
        $validation_errors = $exception->validator->getMessageBag()->toArray();
        $formatted_validation_errors = [];
        if ($validation_errors) {
            foreach ($validation_errors as $key => $error) {
                $formatted_validation_errors[$key] = $error[0];
            }
        }

        return response()->json(['message' => __('messages.validation errors'), 'errors' => $formatted_validation_errors], 422);
    }
}
