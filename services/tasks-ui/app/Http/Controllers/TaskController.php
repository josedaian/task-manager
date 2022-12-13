<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller 
{
    public function index(Request $request)
    {
        return $this->dispatchRequest($request, function() use($request){
            $task = $this->apiClient->taskResources();
    
            if(!$task->isSuccess()){
                return redirect()->route('auth.login')->with('alert', ['type' => 'error', 'text' => $task->getResultMessage(), 'autoDismiss' => 5]);
            }

            $resources = $task->getResultData();
            $filters = $resources->filterGroups;
            $lists = [];
            foreach($filters as $filter){
                $page = $request->get('filter') == $filter ? $request->get('page', 1) : 1;
                $listsTask = $this->apiClient->taskList($filter, $page);
                if(!$listsTask->isSuccess()){
                    return redirect()->route('auth.login')->with('alert', ['type' => 'error', 'text' => $task->getResultMessage(), 'autoDismiss' => 5]);
                }

                $lists[$filter] = $listsTask->getResultData();
            }

            return view('tasks.index')->with(['lists' => $lists]);
        });
    }
}