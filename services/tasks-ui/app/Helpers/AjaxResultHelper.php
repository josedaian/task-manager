<?php

namespace App\Helpers;

class AjaxResultHelper{
    /**
     * @param string $message 
     * @param string $title 
     * @return array 
     */
    static function error(string $message = 'Ha ocurrido un error', string $title = 'Atención'): array {
        return ['success' => false, 'type' => 'error', 'title' => $title, 'message' => $message];
    }

    /**
     * @param string $message 
     * @param string $title 
     * @return array 
     */
    static function success(string $message = 'La operación fue realizada', string $title = 'Éxito!'): array {
        return ['success' => true, 'type' => 'success', 'title' => $title, 'message' => $message];
    }

    /**
     * @param mixed $data 
     * @param string $message 
     * @param string $title 
     * @return array 
     */
    static function successWithData($data, string $message = 'La operación fue realizada', string $title = 'Éxito!'): array {
        return ['success' => true,'type' => 'success', 'title' => $title, 'message' => $message, 'data' => $data];
    }

    /**
     * @param string $message 
     * @param string $title 
     * @return array 
     */
    static function warning(string $message = 'Ha ocurrido un error.', string $title = 'Atención'): array {
        return ['success' => false, 'type' => 'warning', 'title' => $title, 'message' => $message];
    }
}