<?php
namespace App\Enums;

use App\Traits\EnumsToArray;
use Carbon\Carbon;

Enum TaskFilterGroup: int 
{
    use EnumsToArray;
    case TODAY = 1;
    case TOMORROW = 2;
    case NEXT_WEEK = 3;
    case NEXT_MONTH = 4;
    case NEXT_YEAR = 5;

    public function label(): string
    {
        return match($this) {
            TaskFilterGroup::TODAY => 'Today',
            TaskFilterGroup::TOMORROW => 'Tomorrow',
            TaskFilterGroup::NEXT_WEEK => 'Next Week',
            TaskFilterGroup::NEXT_MONTH => 'Next Month',
            TaskFilterGroup::NEXT_YEAR => 'Next Year',
        };
    }

    public function range(): array
    {
        $now = Carbon::now();
        return match($this) {
            TaskFilterGroup::TODAY => [
                $now->startOfDay(), 
                $now->clone()->endOfDay()
            ],
            TaskFilterGroup::TOMORROW => [
                $now->addDay()->startOfDay(), 
                $now->clone()->endOfDay()
            ],
            TaskFilterGroup::NEXT_WEEK => [
                $now->addWeek()->startOfWeek()->startOfDay(),
                $now->clone()->endOfWeek()->endOfDay(),
            ],
            TaskFilterGroup::NEXT_MONTH => [
                $now->addMonth()->startOfMonth()->startOfDay(),
                $now->clone()->endOfMonth()->endOfDay(),
            ],
            TaskFilterGroup::NEXT_YEAR => [
                $now->addYear()->startOfYear()->startOfDay(),
                $now->clone()->endOfYear()->endOfDay(),
            ],
        };
    }

    public static function fromLabel(string $label): self
    {
        return match($label) {
            'Today' => TaskFilterGroup::TODAY,
            'Tomorrow' => TaskFilterGroup::TOMORROW,
            'Next Week' => TaskFilterGroup::NEXT_WEEK,
            'Next Month' => TaskFilterGroup::NEXT_MONTH,
            'Next Year' => TaskFilterGroup::NEXT_YEAR,
        };
    }

}