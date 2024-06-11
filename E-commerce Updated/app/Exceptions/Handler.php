<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
    
    public function render($request, Throwable $exception)
    {
        // Check if the exception is an instance of HttpException and if its status code is 404
        if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
            // Redirect the user to the "home" route
            return redirect()->route('home');
        }

        // Return the default response for other exceptions
        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
