<?php

namespace App\Http\Controllers\v1\ScheduledTask;

use App\Enums\ScheduledTaskDaysOfMonth;
use App\Enums\ScheduledTaskDurationType;
use App\Enums\ScheduledTaskMonths;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduledTask\CreateRequest;
use App\Http\Resources\v1\ScheduledTaskResource;
use App\Models\ScheduledTask;

final class PostCreateController extends Controller 
{
    public function __invoke(CreateRequest $request)
    {
        $scheduledTask = ScheduledTask::createByDurationType(
            ScheduledTaskDaysOfMonth::fromLabel($request->daysOfMonth),
            ScheduledTaskMonths::fromLabel($request->months),
            $request->daysOfWeek,
            ScheduledTaskDurationType::fromLabel($request->durationType),
            $request->durationValue,
            $request->user()
        );

        return $this->successResponse(new ScheduledTaskResource($scheduledTask));
    }
}