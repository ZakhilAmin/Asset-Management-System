<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 204) {
                return response()->view('errors.error204', [], 204);
            }

            if ($exception->getStatusCode() == 302) {
                return response()->view('errors.error302', [], 302);
            }

            if ($exception->getStatusCode() == 401) {
                return response()->view('errors.error401', [], 401);
            }

            if ($exception->getStatusCode() == 403) {
                return response()->view('errors.error403', [], 403);
            }

            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.error404', [], 404);
            }

            if ($exception->getStatusCode() == 500) {
                return response()->view('errors.error500', [], 500);
            }

            if ($exception->getStatusCode() == 501) {
                return response()->view('errors.error501', [], 501);
            }

            if ($exception->getStatusCode() == 502) {
                return response()->view('errors.error502', [], 502);
            }

            if ($exception->getStatusCode() == 504) {
                return response()->view('errors.error504', [], 504);
            }

            if ($exception->getStatusCode() == 505) {
                return response()->view('errors.error505', [], 505);
            }

        }
        return parent::render($request, $exception);
    }
}
