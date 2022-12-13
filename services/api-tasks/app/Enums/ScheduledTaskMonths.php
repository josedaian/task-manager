<?php
namespace App\Enums;

use App\Traits\EnumsToArray;

Enum ScheduledTaskMonths: int 
{
    use EnumsToArray;

    case EVERY_MONTH = 100;
    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    public function label(): string
    {
        return match($this) {
            ScheduledTaskMonths::EVERY_MONTH => 'Every month',
            ScheduledTaskMonths::JANUARY => 'January',
            ScheduledTaskMonths::FEBRUARY => 'February',
            ScheduledTaskMonths::MARCH => 'March',
            ScheduledTaskMonths::APRIL => 'April',
            ScheduledTaskMonths::MAY => 'May',
            ScheduledTaskMonths::JUNE => 'June',
            ScheduledTaskMonths::JULY => 'July',
            ScheduledTaskMonths::AUGUST => 'August',
            ScheduledTaskMonths::SEPTEMBER => 'September',
            ScheduledTaskMonths::OCTOBER => 'October',
            ScheduledTaskMonths::NOVEMBER => 'November',
            ScheduledTaskMonths::DECEMBER => 'December',
        };
    }

    public static function fromLabel(string $label): self
    {
        return match($label) {
            'Every month' => ScheduledTaskMonths::EVERY_MONTH,
            'January' => ScheduledTaskMonths::JANUARY,
            'February' => ScheduledTaskMonths::FEBRUARY,
            'March' => ScheduledTaskMonths::MARCH,
            'April' => ScheduledTaskMonths::APRIL,
            'May' => ScheduledTaskMonths::MAY,
            'June' => ScheduledTaskMonths::JUNE,
            'July' => ScheduledTaskMonths::JULY,
            'August' => ScheduledTaskMonths::AUGUST,
            'September' => ScheduledTaskMonths::SEPTEMBER,
            'October' => ScheduledTaskMonths::OCTOBER,
            'November' => ScheduledTaskMonths::NOVEMBER,
            'December' => ScheduledTaskMonths::DECEMBER,
        };
    }
}