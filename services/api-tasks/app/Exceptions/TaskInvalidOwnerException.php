<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class TaskInvalidOwnerException extends ApiException
{
    protected $message = "The task does not belong to the authenticated user.";
    protected $httpStatus = Response::HTTP_BAD_REQUEST;
}

