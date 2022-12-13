<?php

namespace App\Http\Controllers\v1\Task;

use App\Enums\TaskFilterGroup;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class GetListController extends Controller 
{
    public function __invoke(Request $request)
    {
        $filterGroup = TaskFilterGroup::fromLabel($request->get('filterGroup', TaskFilterGroup::TODAY->label()));
        $tasks = Task::filterGroup($filterGroup)
            ->scheduledTask($request->get('scheduledTaskId'))
            ->orderBy('execute_at', 'asc')
            ->paginate($request->get('limit', 10));
        return $this->successResponse(TaskResource::collection($tasks));
    }
}