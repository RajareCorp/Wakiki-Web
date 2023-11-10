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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function renderHttpException(\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e)
    {
        $status = $e->getStatusCode();

        if (app()->hasDebugModeEnabled() && view()->exists("customError")) {
            return response()->view("customError", compact("status"), $status);
        } else {
            return parent::renderHttpException($e);
        }
    }
}
