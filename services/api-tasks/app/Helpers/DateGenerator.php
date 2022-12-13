<?php

namespace App\Helpers;

use App\Enums\ScheduledTaskDaysOfMonth;
use App\Enums\ScheduledTaskDaysOfWeek;
use App\Enums\ScheduledTaskMonths;
use App\Models\ScheduledTask;
use Cron\CronExpression;
use Illuminate\Console\Scheduling\ManagesFrequencies;

abstract class DateGenerator
{
    use ManagesFrequencies;

    /** @var ScheduledTask */
    protected $scheduledTask;

    /** @var string */
    protected $expression = '* * * * *';

    public function __construct(ScheduledTask $scheduledTask)
    {
        $this->scheduledTask = $scheduledTask;
    }

    protected function buildExpresion(): void
    {
        $specificDateToExecute = null;
        switch ($this->scheduledTask->days_of_month) 
        {
            case ScheduledTaskDaysOfMonth::EVERY_DAY:
                $this->daily();
                break;

            default:
                $specificDateToExecute = $this->scheduledTask->days_of_month->value;
                $this->monthlyOn($this->scheduledTask->days_of_month->value);
                break;
        }

        switch ($this->scheduledTask->months) 
        {
            case ScheduledTaskMonths::EVERY_MONTH:
                $this->monthly();
                break;

            case ScheduledTaskMonths::EVERY_3_MONTHS;
                $this->quarterly();
                break;

            default:
                if($specificDateToExecute){
                    $this->yearlyOn($this->scheduledTask->months->value, $specificDateToExecute);
                }else{
                    $this->yearlyOn($this->scheduledTask->months->value);
                }
                break;
        }

        $days = array_map(
            fn(ScheduledTaskDaysOfWeek $enum) => $enum->toConst(),
            $this->scheduledTask->days_of_week_enums
        );
        $this->days($days);
    }

    protected function getCronInstance(): CronExpression
    {
        $this->buildExpresion();
        return new CronExpression($this->expression);
    }

    abstract function execute(): array;
}
