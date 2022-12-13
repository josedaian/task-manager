<?php

namespace App\Helpers;

class DateGeneratorByIterationQuantity extends DateGenerator
{
    public function execute(): array
    {
        return $this->getCronInstance()
            ->getMultipleRunDates($this->scheduledTask->total_tasks);
    }
}