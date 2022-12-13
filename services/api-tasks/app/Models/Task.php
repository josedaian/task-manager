<?php

namespace App\Models;

use App\Enums\TaskFilterGroup;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'execute_at',
        'scheduled_task_id',
        'status',
        'user_id',
    ];

    protected $casts = [
        'execute_at' => 'datetime',
        'status' => TaskStatus::class
    ];

    protected static function booted()
    {
        static::updated(function ($task) {
            if($task->wasChanged('status') && $task->status === TaskStatus::COMPLETED){
                $scheduledTask = ScheduledTask::find($task->scheduled_task_id);
                $scheduledTask->total_executed = $scheduledTask->total_executed + 1;
                $scheduledTask->last_execution = $task->updated_at;
                $scheduledTask->save();
            }
        });
    }

    public static function createByScheduledTask(ScheduledTask $scheduledTask, Carbon $executeAt): Task
    {
        $task = new Task;
        $task->execute_at = $executeAt;
        $task->scheduled_task_id = $scheduledTask->id;
        $task->user_id = $scheduledTask->user_id;
        $task->status = TaskStatus::PENDING;
        $task->saveOrFail();
        return $task;
    }

    public function scopeFilterGroup($query, TaskFilterGroup $filter)
    {
        return $query->whereBetween('execute_at', $filter->range());
    }

    public function scopeScheduledTask($query, ?int $scheduledTaskId = null)
    {
        if($scheduledTaskId){
            return $query->where('scheduled_task_id', $scheduledTaskId);
        }
    }
}
