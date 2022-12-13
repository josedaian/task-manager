<?php
namespace App\Enums;

use App\Traits\EnumsToArray;

Enum ScheduledTaskDurationType: int 
{
    use EnumsToArray;
    case DATERANGE = 1;
    case QUANTITY = 2;

    public function label(): string
    {
        return match($this) {
            ScheduledTaskDurationType::DATERANGE => 'Date range',
            ScheduledTaskDurationType::QUANTITY => 'Quantity',
        };
    }
    
    public static function fromLabel(string $label): self
    {
        return match($label) {
            'Date range' => ScheduledTaskDurationType::DATERANGE,
            'Quantity' => ScheduledTaskDurationType::QUANTITY,
        };
    }

    public function datesGeneratorClass(): string
    {
        return match($this) {
            ScheduledTaskDurationType::DATERANGE => \App\Helpers\DateGeneratorByDateRange::class,
            ScheduledTaskDurationType::QUANTITY => \App\Helpers\DateGeneratorByIterationQuantity::class,
        };
    }
}