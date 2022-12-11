<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ApiException extends \Exception
{
    protected $httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function setHttpStatus(int $httpStatus): ApiException
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }
}

