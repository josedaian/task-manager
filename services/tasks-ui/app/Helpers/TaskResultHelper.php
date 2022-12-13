<?php

namespace App\Helpers;

class TaskResultHelper
{
    private $status, $data, $prop = [];

    /**
     * @param mixed $status 
     * @param mixed $data 
     * @return void 
     */
    private function __construct($status, $data)
    {
        $this->status = $status;
        $this->data = $data;
    }

    /** @return bool  */
    function isSuccess(): bool{
        return $this->status['status'] === 'success';
    }

    /** @return mixed  */
    function getResultCode() {
        return $this->status['code'];
    }

    /** @return null|string  */
    function getResultMessage():?string {
        return $this->status['message'];
    }

    /** @return mixed  */
    function getResultData() {
        return $this->data;
    }
    
    /**
     * @param string $name 
     * @param mixed $value 
     * @return void 
     */
    function setProperty(string $name, $value) {
        $this->prop[$name] = $value;
    }

    /**
     * @param string $name 
     * @return mixed 
     */
    function getProperty(string $name) {
        return isset( $this->prop[$name] ) ? $this->prop[$name] : null;
    }

    /**
     * @param string $message 
     * @param int $code 
     * @return TaskResultHelper 
     */
    function changeToError($message = '', $code = 0): self {
        $this->status = ['status' => 'error', 'code' => $code,'message' => $message];
        return $this;
    }

    /**
     * @param string $message 
     * @param int $code 
     * @param mixed $data 
     * @return TaskResultHelper 
     */
    static function errorResponse($message = '', $code = 0, $data = null): TaskResultHelper {
        return new TaskResultHelper(['status' => 'error', 'code' => $code, 'message' => $message], $data);
    }

    /**
     * @param array $data 
     * @param string $message 
     * @param int $code 
     * @return TaskResultHelper 
     */
    static function successResponse($data = [], $message = 'Petición exitosa', $code = 0): TaskResultHelper {
        return new TaskResultHelper(['status' => 'success', 'code' => $code, 'message' => $message], $data);
    }
}
