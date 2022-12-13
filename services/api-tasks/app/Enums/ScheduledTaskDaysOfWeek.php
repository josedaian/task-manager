<?php
namespace App\Enums;

use App\Traits\EnumsToArray;
use Illuminate\Console\Scheduling\Schedule;

Enum ScheduledTaskDaysOfWeek: int 
{
    use EnumsToArray;

    case SUNDAY = 1;
    case MONDAY = 2;
    case TUESDAY = 3;
    case WEDNESDAY = 4;
    case THURSDAY = 5;
    case FRIDAY = 6;
    case SATURDAY = 7;

    public function label(): string
    {
        return match($this) {
            ScheduledTaskDaysOfWeek::SUNDAY => 'Sunday',
            ScheduledTaskDaysOfWeek::MONDAY => 'Monday',
            ScheduledTaskDaysOfWeek::TUESDAY => 'Tuesday',
            ScheduledTaskDaysOfWeek::WEDNESDAY => 'Wednesday',
            ScheduledTaskDaysOfWeek::THURSDAY => 'Thursday',
            ScheduledTaskDaysOfWeek::FRIDAY => 'Friday',
            ScheduledTaskDaysOfWeek::SATURDAY => 'Saturday',
        };
    }

    public static function fromLabel(string $label): self
    {
        return match($label) {
            'Sunday' => ScheduledTaskDaysOfWeek::SUNDAY,
            'Monday' => ScheduledTaskDaysOfWeek::MONDAY,
            'Tuesday' => ScheduledTaskDaysOfWeek::TUESDAY,
            'Wednesday' => ScheduledTaskDaysOfWeek::WEDNESDAY,
            'Thursday' => ScheduledTaskDaysOfWeek::THURSDAY,
            'Friday' => ScheduledTaskDaysOfWeek::FRIDAY,
            'Saturday' => ScheduledTaskDaysOfWeek::SATURDAY,
        };
    }

    public function toConst(): int
    {
        return match($this) {
            ScheduledTaskDaysOfWeek::SUNDAY => Schedule::SUNDAY,
            ScheduledTaskDaysOfWeek::MONDAY => Schedule::MONDAY,
            ScheduledTaskDaysOfWeek::TUESDAY => Schedule::TUESDAY,
            ScheduledTaskDaysOfWeek::WEDNESDAY => Schedule::WEDNESDAY,
            ScheduledTaskDaysOfWeek::THURSDAY => Schedule::THURSDAY,
            ScheduledTaskDaysOfWeek::FRIDAY => Schedule::FRIDAY,
            ScheduledTaskDaysOfWeek::SATURDAY => Schedule::SATURDAY,
        };
    }
}