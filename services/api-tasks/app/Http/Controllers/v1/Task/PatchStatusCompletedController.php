<?php

namespace App\Http\Controllers\v1\Task;

use App\Enums\TaskStatus;
use App\Exceptions\TaskAlreadyCompletedException;
use App\Exceptions\TaskInvalidOwnerException;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

final class PatchStatusCompletedController extends Controller 
{
    public function __invoke(Request $request, int $id)
    {
        $task = Task::find($id);
        $this->ensureHasValidStatusAndOwner($task, $request->user());
        $task->status = TaskStatus::COMPLETED;
        $task->save();
        return $this->successResponse(new TaskResource($task));
    }

    protected function ensureHasValidStatusAndOwner(Task $task, User $user): void
    {
        if($task->status === TaskStatus::COMPLETED){
            throw new TaskAlreadyCompletedException;
        } 

        if($task->user_id <> $user->id){
            throw new TaskInvalidOwnerException;
        }
    }
}