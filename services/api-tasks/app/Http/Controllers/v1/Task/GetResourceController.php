<?php

namespace App\Http\Controllers\v1\Task;

use App\Enums\TaskFilterGroup;
use App\Http\Controllers\Controller;

class GetResourceController extends Controller 
{
    public function __invoke()
    {
        return $this->successResponse([
            'filterGroups' => TaskFilterGroup::toArrayWithLabel()
        ]);
    }
}