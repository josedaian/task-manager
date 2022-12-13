<?php
namespace App\Enums;

use App\Traits\EnumsToArray;

Enum ScheduledTaskStatus: int 
{
    use EnumsToArray;
    case REGISTERED = 1;
    case RUNNING = 2;
    case COMPLETED = 3;

    public function label(): string
    {
        return match($this) {
            ScheduledTaskStatus::REGISTERED => 'registered',
            ScheduledTaskStatus::RUNNING => 'running',
            ScheduledTaskStatus::COMPLETED => 'completed',
        };
    }
}