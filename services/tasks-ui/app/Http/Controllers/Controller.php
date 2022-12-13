<?php

namespace App\Http\Controllers;

use App\Helpers\AjaxResultHelper;
use App\Services\BackendApiClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $apiClient;

    public function __construct(BackendApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    protected function dispatchRequest(Request $request, $callback, ?Route $redirectPathOnError = null) 
    {
        try {
            ignore_user_abort(true);
            return call_user_func($callback);
            
        } catch (\Throwable $unknown) {
            \Log::error($this->getCallerClassAndMethod($unknown), ['error', $unknown]);
            if($request->isJson()){
                return AjaxResultHelper::error($unknown->getMessage());
            }
            
            session()->flash('alert', ['type' => 'error', 'text' => __('Ha ocurrido un error. Para más información contáctese con el soporte técnico'), 'autoDismiss' => 5]);
            
            if($redirectPathOnError){
                return redirect()->route($redirectPathOnError)->withInput();
            }

            return back()->withInput();
        }
    }

    private function getCallerClassAndMethod(\Throwable $exception): string
    {
        $trace = $exception->getTrace();
        $childController = $trace[3];
        return $childController['class'].'@'.$childController['function'];
    }
}
