<?php

namespace App\Jobs;

use App\Models\ScheduledTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduledTask;

    public function __construct(ScheduledTask $scheduledTask)
    {
        $this->scheduledTask = $scheduledTask;
    }

    public function handle()
    {
        $dateGeneratorClass = $this->scheduledTask->duration_type->datesGeneratorClass();
        /** @var DateGenerator $dateGenerator */
        $dateGenerator = new $dateGeneratorClass($this->scheduledTask);
        $dates = $dateGenerator->execute();
        foreach ($dates as $date) {
            Task::createByScheduledTask($this->scheduledTask, Carbon::parse($date));
        }
    }
}
