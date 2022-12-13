<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateGeneratorByDateRange extends DateGenerator
{
    public function execute(): array
    {
        $dates = [];
        $executeDate = $this->scheduledTask->execute_from;
        /** @var Carbon $lastDate */
        $lastDate = $this->scheduledTask->execute_to;

        $cron = $this->getCronInstance();
        $executeDate = $cron->getNextRunDate($executeDate, 0, true);

        if($lastDate->lt($executeDate)){
            return [];
        }

        $dates[] = $executeDate;
        
        for(;;){
            $result = $cron->getNextRunDate($executeDate);
            $executeDate = clone $result;
            $dates[] = $result;

            if(!($lastDate->gt($result))){
                break;
            }
        }

        return $dates;
    }
}