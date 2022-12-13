<?php
namespace App\Enums;

use App\Traits\EnumsToArray;

Enum ScheduledTaskDaysOfMonth: int 
{
    use EnumsToArray;

    case EVERY_DAY = 100;
    case DAY_1 = 1;
    case DAY_2 = 2;
    case DAY_3 = 3;
    case DAY_4 = 4;
    case DAY_5 = 5;
    case DAY_6 = 6;
    case DAY_7 = 7;
    case DAY_8 = 8;
    case DAY_9 = 9;
    case DAY_10 = 10;
    case DAY_11 = 11;
    case DAY_12 = 12;
    case DAY_13 = 13;
    case DAY_14 = 14;
    case DAY_15 = 15;
    case DAY_16 = 16;
    case DAY_17 = 17;
    case DAY_18 = 18;
    case DAY_19 = 19;
    case DAY_20 = 20;
    case DAY_21 = 21;
    case DAY_22 = 22;
    case DAY_23 = 23;
    case DAY_24 = 24;
    case DAY_25 = 25;
    case DAY_26 = 26;
    case DAY_27 = 27;
    case DAY_28 = 28;
    case DAY_29 = 29;
    case DAY_30 = 30;
    case DAY_31 = 31;

    public function label(): string
    {
        return match($this) {
            ScheduledTaskDaysOfMonth::EVERY_DAY => 'Every day',
            ScheduledTaskDaysOfMonth::DAY_1 => '1',
            ScheduledTaskDaysOfMonth::DAY_2 => '2',
            ScheduledTaskDaysOfMonth::DAY_3 => '3',
            ScheduledTaskDaysOfMonth::DAY_4 => '4',
            ScheduledTaskDaysOfMonth::DAY_5 => '5',
            ScheduledTaskDaysOfMonth::DAY_6 => '6',
            ScheduledTaskDaysOfMonth::DAY_7 => '7',
            ScheduledTaskDaysOfMonth::DAY_8 => '8',
            ScheduledTaskDaysOfMonth::DAY_9 => '9',
            ScheduledTaskDaysOfMonth::DAY_10 => '10',
            ScheduledTaskDaysOfMonth::DAY_11 => '11',
            ScheduledTaskDaysOfMonth::DAY_12 => '12',
            ScheduledTaskDaysOfMonth::DAY_13 => '13',
            ScheduledTaskDaysOfMonth::DAY_14 => '14',
            ScheduledTaskDaysOfMonth::DAY_15 => '15',
            ScheduledTaskDaysOfMonth::DAY_16 => '16',
            ScheduledTaskDaysOfMonth::DAY_17 => '17',
            ScheduledTaskDaysOfMonth::DAY_18 => '18',
            ScheduledTaskDaysOfMonth::DAY_19 => '19',
            ScheduledTaskDaysOfMonth::DAY_20 => '20',
            ScheduledTaskDaysOfMonth::DAY_21 => '21',
            ScheduledTaskDaysOfMonth::DAY_22 => '22',
            ScheduledTaskDaysOfMonth::DAY_23 => '23',
            ScheduledTaskDaysOfMonth::DAY_24 => '24',
            ScheduledTaskDaysOfMonth::DAY_25 => '25',
            ScheduledTaskDaysOfMonth::DAY_26 => '26',
            ScheduledTaskDaysOfMonth::DAY_27 => '27',
            ScheduledTaskDaysOfMonth::DAY_28 => '28',
            ScheduledTaskDaysOfMonth::DAY_29 => '29',
            ScheduledTaskDaysOfMonth::DAY_30 => '30',
            ScheduledTaskDaysOfMonth::DAY_31 => '31',
        };
    }

    public static function fromLabel(string $label): self
    {
        return match($label) {
            'Every day' => ScheduledTaskDaysOfMonth::EVERY_DAY,
            '1' => ScheduledTaskDaysOfMonth::DAY_1,
            '2' => ScheduledTaskDaysOfMonth::DAY_2,
            '3' => ScheduledTaskDaysOfMonth::DAY_3,
            '4' => ScheduledTaskDaysOfMonth::DAY_4,
            '5' => ScheduledTaskDaysOfMonth::DAY_5,
            '6' => ScheduledTaskDaysOfMonth::DAY_6,
            '7' => ScheduledTaskDaysOfMonth::DAY_7,
            '8' => ScheduledTaskDaysOfMonth::DAY_8,
            '9' => ScheduledTaskDaysOfMonth::DAY_9,
            '10' => ScheduledTaskDaysOfMonth::DAY_10,
            '11' => ScheduledTaskDaysOfMonth::DAY_11,
            '12' => ScheduledTaskDaysOfMonth::DAY_12,
            '13' => ScheduledTaskDaysOfMonth::DAY_13,
            '14' => ScheduledTaskDaysOfMonth::DAY_14,
            '15' => ScheduledTaskDaysOfMonth::DAY_15,
            '16' => ScheduledTaskDaysOfMonth::DAY_16,
            '17' => ScheduledTaskDaysOfMonth::DAY_17,
            '18' => ScheduledTaskDaysOfMonth::DAY_18,
            '19' => ScheduledTaskDaysOfMonth::DAY_19,
            '20' => ScheduledTaskDaysOfMonth::DAY_20,
            '21' => ScheduledTaskDaysOfMonth::DAY_21,
            '22' => ScheduledTaskDaysOfMonth::DAY_22,
            '23' => ScheduledTaskDaysOfMonth::DAY_23,
            '24' => ScheduledTaskDaysOfMonth::DAY_24,
            '25' => ScheduledTaskDaysOfMonth::DAY_25,
            '26' => ScheduledTaskDaysOfMonth::DAY_26,
            '27' => ScheduledTaskDaysOfMonth::DAY_27,
            '28' => ScheduledTaskDaysOfMonth::DAY_28,
            '29' => ScheduledTaskDaysOfMonth::DAY_29,
            '30' => ScheduledTaskDaysOfMonth::DAY_30,
            '31' => ScheduledTaskDaysOfMonth::DAY_31,
        };
    }
}