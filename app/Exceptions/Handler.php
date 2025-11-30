<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LoggerInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Let Laravel log or external services handle it.
            logger()->error($e->getMessage(), ['exception' => $e]);
        });
    }

    public function render($request, Throwable $e)
    {
        // In production show a friendly 500 page
        if ($this->shouldReturnCustomErrorPage($request, $e)) {
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            if ($status === 404) {
                return response()->view('errors.404', ['exception' => $e], 404);
            }

            return response()->view('errors.500', ['exception' => $e], $status ?: 500);
        }

        return parent::render($request, $e);
    }

    protected function shouldReturnCustomErrorPage($request, Throwable $e): bool
    {
        // Return custom pages for HTML requests when debug is off.
        return !$request->expectsJson() && !config('app.debug');
    }
}
