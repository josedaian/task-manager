<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller 
{
    public function index(Request $request)
    {
        return $this->dispatchRequest($request, function() use($request){
            $task = $this->apiClient->scheduledTaskList($request->get('page', 1));
    
            if(!$task->isSuccess()){
                return redirect()->route('tasks.index')->with('alert', ['type' => 'error', 'text' => $task->getResultMessage(), 'autoDismiss' => 5]);
            }

            return view('scheduled-tasks.index')->with(['list' => $task->getResultData()]);
        });
    }

    public function create(Request $request)
    {
        return $this->dispatchRequest($request, function() use($request){
            $scheduleTask = $this->apiClient->scheduleResources();
    
            if(!$scheduleTask->isSuccess()){
                return redirect()->route('tasks.index')->with('alert', ['type' => 'error', 'text' => $scheduleTask->getResultMessage(), 'autoDismiss' => 5]);
            }

            $data = $scheduleTask->getResultData();
            $daysOfMonth = collect($data->daysOfMonth)->mapWithKeys(function($value, $key){
                return [$value => $value];
            });

            $months = collect($data->months)->mapWithKeys(function($value, $key){
                return [$value => $value];
            });

            $daysOfWeek = collect($data->daysOfWeek)->mapWithKeys(function($value, $key){
                return [$value => $value];
            });

            $durationType = collect($data->durationType)->mapWithKeys(function($value, $key){
                return [$value => $value];
            });
            
            return view('scheduled-tasks.create')->with([
                'daysOfMonth' => $daysOfMonth,
                'months' => $months,
                'daysOfWeek' => $daysOfWeek,
                'durationType' => $durationType,
            ]);
        });
    }

    public function save(Request $request)
    {
        $data = [
            "daysOfMonth" => $request->daysOfMonth,
            "months" => $request->months,
            "daysOfWeek" => $request->daysOfWeek,
            "durationType" => $request->durationType,
            "durationValue" => $request->durationType == 'Date range' ? $request->durationValueRange : $request->durationValueQuantity
        ];

        $scheduleTask = $this->apiClient->createSchedule($data);

        if(!$scheduleTask->isSuccess()){
            return redirect()->route('scheduled_tasks.index')->with('alert', ['type' => 'error', 'text' => $scheduleTask->getResultMessage(), 'autoDismiss' => 5]);
        }else{
            return redirect()->route('scheduled_tasks.index')->with('alert', ['type' => 'success', 'text' => 'Success! New record in the house', 'autoDismiss' => 5]);
        }
    }
}