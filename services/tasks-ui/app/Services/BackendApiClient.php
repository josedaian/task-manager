<?php

namespace App\Services;

use App\Helpers\AuthSessionHelper;
use App\Helpers\TaskResultHelper;
use App\Traits\ApiRequest;
use Exception;
use Illuminate\Http\Client\Response;

class BackendApiClient 
{
    use ApiRequest;
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('taskmanager.api.url');
    }

    static function buildInstance(): BackendApiClient 
    {
        return new BackendApiClient;
    }

    private function getBearerToken(): ?string 
    {
        return AuthSessionHelper::getCurrent()->getTokenValue();
    }
    
    function authLogin(array $loginParams): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/auth/login', function(array $requestParams) use($loginParams)
        {
            return $this->apiPost($requestParams, $loginParams);
        },['noAuth' => true]);
    }

    function authSignUp(array $data): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/auth/register', function(array $requestParams) use($data)
        {
            return $this->apiPost($requestParams, $data);
        },['noAuth' => true]);
    }

    function taskResources(): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/tasks/resources', function(array $requestParams)
        {
            return $this->apiGet($requestParams);
        });
    }

    function taskList(string $filter, int $page = 1, ?int $scheduledTaskId = null): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/tasks', function(array $requestParams) use($filter, $page, $scheduledTaskId)
        {
            return $this->apiGet($requestParams, ['filterGroup' => $filter, 'page' => $page, 'scheduledTaskId' => $scheduledTaskId]);
        });
    }

    function taskCompleted(int $taskId): TaskResultHelper 
    {
        return $this->invokeApiEndpoint("/tasks/completed/$taskId", function(array $requestParams)
        {
            return $this->apiPatch($requestParams);
        });
    }

    function scheduleResources(): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/scheduled-tasks/resources', function(array $requestParams)
        {
            return $this->apiGet($requestParams);
        });
    }

    function createSchedule($data): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/scheduled-tasks', function(array $requestParams) use($data)
        {
            return $this->apiPost($requestParams, $data);
        });
    }

    function scheduledTaskList(int $page = 1): TaskResultHelper 
    {
        return $this->invokeApiEndpoint('/scheduled-tasks', function(array $requestParams) use($page)
        {
            return $this->apiGet($requestParams, ['page' => $page]);
        });
    }

    private function invokeApiEndpoint(string $endpoint, callable $callback, array $options = []): TaskResultHelper 
    {
        try {
            $json = null;
            $requestParams = $this->getEndpointWithHeader($endpoint, $options);

            $response = call_user_func($callback, $requestParams); 
            if( $response ){
                if( $response instanceOf Response){
                    $json = $response->object();
                } else if( $response instanceOf \stdClass){
                    $json = $response;
                }
            }

            if( !empty($options['raw']) ){ // RAW MODE
                if( !$json ) {
                    \Log::warning(__FUNCTION__."($endpoint): INVALID_RAW", ['request' => $requestParams, 'response' => $response]);
                    return TaskResultHelper::errorResponse(__('Error en la respuesta del API'), 'api.error');
                }
                return TaskResultHelper::successResponse($json, null, null );
            }
                
            if( !($json && isset($json->meta) && isset($json->meta->success)) ) {
                \Log::warning(__FUNCTION__."($endpoint): INVALID_JSON", ['requestParams' => $requestParams, 'response' => $response]);
                return TaskResultHelper::errorResponse(__('Error en la respuesta del API'), 'api.error');
            }

            if( $json->meta->success !== true){
                \Log::warning(__FUNCTION__."($endpoint): ERROR", ['requestParams' => $requestParams, 'json' => $json]);
                return TaskResultHelper::errorResponse($json->meta->message, $json->meta->infoCode ?? null, $json->data ?? null );
            }
            return TaskResultHelper::successResponse($json->data, $json->meta->message ?? null, $json->meta->infoCode ?? null);
            
        } catch (Exception $exception) {
            \Log::error(__FUNCTION__."($endpoint)", ['error' => $exception]);
            return TaskResultHelper::errorResponse(__('Ha ocurrido un error:').$exception->getMessage(), $exception->getCode());
        }
    }

    function getEndpointWithHeader(string $endpoint, array $options): array 
    {
        $headers = [];
        if( empty($options['noAuth']) ){
            $headers['Authorization'] = 'Bearer '.$this->getBearerToken();
        }

        return [
            'endpoint' => $endpoint,
            'url' =>  $this->apiUrl . $endpoint,
            'headers' => $headers,
            'options' => [
                'connect_timeout' => 30,
                'verify' => false
            ]
        ];
    }
}