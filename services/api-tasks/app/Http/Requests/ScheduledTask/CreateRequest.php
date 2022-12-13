<?php

namespace App\Http\Requests\ScheduledTask;

use App\Http\Requests\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'daysOfMonth' => 'required',
            'months' => 'required',
            'daysOfWeek' => 'required|array',
            'durationType' => 'required',
            'durationValue' => 'required',
        ];
    }
}
