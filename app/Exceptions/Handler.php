<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class Handler.
 */
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
     * @var array $dontFlash A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception Exception class.
     *
     * @return void
     *
     * @throws Exception Exception.
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request   $request   Request.
     * @param Exception $exception Exception.
     *
     * @return Response
     *
     * phpcs:disable
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
