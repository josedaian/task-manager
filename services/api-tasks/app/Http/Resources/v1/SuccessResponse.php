<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResponse extends JsonResource {
    public function toArray($request): array
    {
        return [
            'meta' => [
                'success' => true,
                'message' => 'Ok',
            ],
            'data' => $this->resource
        ];
    }
}