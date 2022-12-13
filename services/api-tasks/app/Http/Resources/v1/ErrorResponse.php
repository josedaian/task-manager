<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponse extends JsonResource 
{
    private $exception;

    public static function fromException(\Exception $exception): ErrorResponse 
    {
        $self = new ErrorResponse(null);
        $self->exception = $exception;
        $self->withoutWrapping();
        return $self;
    }

    public function toArray($request): array
    {
        return [
            'meta' => [
                'success' => false,
                'message' => $this->exception->getMessage(),
            ]
        ];
    }
}