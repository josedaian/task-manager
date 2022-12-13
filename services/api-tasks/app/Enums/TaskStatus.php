<?php
namespace App\Enums;

use App\Traits\EnumsToArray;

Enum TaskStatus: int 
{
    use EnumsToArray;
    case PENDING = 1;
    case COMPLETED = 2;

    public function label(): string
    {
        return match($this) {
            TaskStatus::PENDING => 'pending',
            TaskStatus::COMPLETED => 'completed',
        };
    }
}