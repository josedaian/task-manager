<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            $httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            
            if ($e instanceof NotFoundHttpException) {
                $httpStatus = Response::HTTP_NOT_FOUND;
                
            } else if($e instanceof \Illuminate\Auth\AuthenticationException) {
                $message = !empty($e->getMessage()) ? $e->getMessage() : "Invalid token";
                $httpStatus = Response::HTTP_UNAUTHORIZED;

            } else if ($e instanceof \UnhandledMatchError) {
                $message = !empty($e->getMessage()) ? $e->getMessage() : "Unmatched value";
                $httpStatus = Response::HTTP_BAD_REQUEST;
                
            } else if($e instanceof QueryException) {
                
                if($e->getCode() === '23000'){
                    $message = "Duplicade entry. Record has already exists.";
                }else{
                    $message = "Internal DB error";
                }
                
            } else {
                \Log::error(__METHOD__, ['exception' => $e, 'request' => $request]);
                dd($e);
                $message = "An error has ocurred";
            }

            $apiVersion = config('app.api.version');
            $resourceName = sprintf('\App\Http\Resources\v%s\ErrorResponse', $apiVersion);
            
            if(!($e instanceof ApiException)){
                $e = new ApiException($message);
                $e->setHttpStatus($httpStatus);
            }

            return $resourceName::fromException($e)
                ->response()
                ->setStatusCode($e->getHttpStatus());
        });
    }
}
