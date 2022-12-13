<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class TaskAlreadyCompletedException extends ApiException
{
    protected $message = "The task is already marked as complete";
    protected $httpStatus = Response::HTTP_BAD_REQUEST;
}

