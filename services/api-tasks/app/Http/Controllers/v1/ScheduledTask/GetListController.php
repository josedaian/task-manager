<?php

namespace App\Http\Controllers\v1\ScheduledTask;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ScheduledTaskResource;
use App\Models\ScheduledTask;
use Illuminate\Http\Request;

class GetListController extends Controller 
{
    public function __invoke(Request $request)
    {
        $scheduledTasks = ScheduledTask::paginate($request->get('limit', 10));
        return $this->successResponse(ScheduledTaskResource::collection($scheduledTasks));
    }
}