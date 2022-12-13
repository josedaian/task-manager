<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SuccessResponse extends JsonResource 
{
    public function toArray($request): array
    {
        $resource = $this->resource;
        if($resource instanceof ResourceCollection){
            $resource = $this->resource->appends($this->queryParameters);
        }
        return [
            'meta' => [
                'success' => true,
                'message' => 'Ok',
            ],
            'data' => $resource
        ];
    }
}