<?php

namespace App\Models;

use App\Enums\ScheduledTaskDaysOfMonth;
use App\Enums\ScheduledTaskDaysOfWeek;
use App\Enums\ScheduledTaskDurationType;
use App\Enums\ScheduledTaskMonths;
use App\Enums\ScheduledTaskStatus;
use App\Exceptions\BadRequestException;
use App\Helpers\DateGenerator;
use App\Jobs\GenerateTasks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'days_of_month',
        'months',
        'days_of_week',
        'duration_type',
        'total_tasks',
        'total_executed',
        'execute_from',
        'execute_to',
        'last_execution',
        'status',
        'user_id',
    ];

    protected $casts = [
        'last_execution' => 'datetime',
        'execute_from' => 'datetime',
        'execute_to' => 'datetime',
        'status' => ScheduledTaskStatus::class,
        'days_of_month' => ScheduledTaskDaysOfMonth::class,
        'months' => ScheduledTaskMonths::class,
        'days_of_week' => AsArrayObject::class,
        'duration_type' => ScheduledTaskDurationType::class,
    ];

    protected static function booted()
    {
        static::created(function ($scheduledTask) {
            GenerateTasks::dispatch($scheduledTask);
        });
    }

    public function getDaysOfWeekEnumsAttribute(): array
    {
        $days = [];
        foreach($this->days_of_week as $day){
            $days[] = ScheduledTaskDaysOfWeek::from($day);
        }

        return $days;
    }

    public static function createByDurationType(
        ScheduledTaskDaysOfMonth $daysOfMonth,
        ScheduledTaskMonths $months,
        array $daysOfWeek,
        ScheduledTaskDurationType $durationType,
        string $durationValue,
        User $user
    ): ScheduledTask
    {
        $daysOfWeekEnum = [];
        foreach($daysOfWeek as $day){
            $daysOfWeekEnum[] = ScheduledTaskDaysOfWeek::fromLabel($day);
        }

        $scheduledTask = new ScheduledTask();
        $scheduledTask->days_of_month = $daysOfMonth;
        $scheduledTask->months = $months;
        $scheduledTask->days_of_week = $daysOfWeekEnum;
        $scheduledTask->duration_type = $durationType;

        if ($durationType === ScheduledTaskDurationType::QUANTITY) {
            $scheduledTask->total_tasks = (int) $durationValue;
            $scheduledTask->execute_from = Carbon::now();
            $scheduledTask->execute_to = Carbon::now();
        } else {
            $scheduledTask->total_tasks = 0;
            $dateRange = explode('|', $durationValue);
            if (count($dateRange) <= 1) {
                throw new BadRequestException;
            }

            $scheduledTask->execute_from = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $scheduledTask->execute_to = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
        }

        $scheduledTask->total_executed = 0;
        $scheduledTask->status = ScheduledTaskStatus::REGISTERED;
        $scheduledTask->user_id = $user->id;
        $scheduledTask->updateTotalCountAndFirstLastExecuteDate();

        return $scheduledTask;
    }

    private function updateTotalCountAndFirstLastExecuteDate(): void
    {
        $dateGeneratorClass = $this->duration_type->datesGeneratorClass();
        /** @var DateGenerator $dateGenerator */
        $dateGenerator = new $dateGeneratorClass($this);
        $dates = $dateGenerator->execute();
        $this->total_tasks = count($dates);
        $this->execute_from = Carbon::parse($dates[0]);
        $this->execute_to = Carbon::parse(end($dates));
        $this->save();
    }
}
