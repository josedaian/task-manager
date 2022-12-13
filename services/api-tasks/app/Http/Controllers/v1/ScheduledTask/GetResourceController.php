<?php

namespace App\Http\Controllers\v1\ScheduledTask;

use App\Enums\ScheduledTaskDaysOfMonth;
use App\Enums\ScheduledTaskDaysOfWeek;
use App\Enums\ScheduledTaskDurationType;
use App\Enums\ScheduledTaskMonths;
use App\Http\Controllers\Controller;

class GetResourceController extends Controller 
{
    public function __invoke()
    {
        return $this->successResponse([
            'daysOfMonth' => ScheduledTaskDaysOfMonth::toArrayWithLabel(),
            'months' => ScheduledTaskMonths::toArrayWithLabel(),
            'daysOfWeek' => ScheduledTaskDaysOfWeek::toArrayWithLabel(),
            'durationType' => ScheduledTaskDurationType::toArrayWithLabel(),
        ]);
    }
}