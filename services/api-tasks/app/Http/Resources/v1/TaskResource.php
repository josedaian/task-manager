<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource 
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'executeAt' => $this->execute_at->toIso8601String(),
            'scheduledTaskId' => $this->scheduled_task_id,
            'status' => $this->status->label(),
            'userId' => $this->user_id,
            'createdAt' => $this->created_at->toIso8601String(),
        ];
    }
}