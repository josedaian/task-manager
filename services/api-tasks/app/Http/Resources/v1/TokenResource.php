<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource 
{
    public function toArray($request): array
    {
        return [
            'token' => $this->plainTextToken,
            'expiresAt' => $this->accessToken->expires_at->toIso8601String(),
            'abilities' => $this->accessToken->abilities
        ];
    }
}