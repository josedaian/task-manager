<?php

namespace App\Http\Resources\v1;

use App\Enums\ScheduledTaskDaysOfWeek;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduledTaskResource extends JsonResource 
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'daysOfMonth' => $this->days_of_month->label(),
            'months' => $this->months->label(),
            'daysOfWeek' => array_map(
                fn(ScheduledTaskDaysOfWeek $enum) => $enum->label(),
                $this->days_of_week_enums
            ),
            'durationType' => $this->duration_type->label(),
            'totalTasks' => $this->total_tasks,
            'totalExecuted' => $this->total_executed,
            'executeFrom' => $this->execute_from->toIso8601String(),
            'executeTo' => $this->execute_to->toIso8601String(),
            'lastExecution' => $this->last_execution ? $this->last_execution->toIso8601String() : null,
            'status' => $this->status->label(),
            'userId' => $this->user_id,
            'createdAt' => $this->created_at->toIso8601String(),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}