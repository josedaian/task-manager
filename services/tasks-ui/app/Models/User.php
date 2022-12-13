<?php

namespace App\Models;

class User
{
    private $name, $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    function getEmail(): ?string  
    {
        return $this->email;
    }

    static function buildFromApiModel(\stdClass $apiModel): self
    {
        return new User($apiModel->name, $apiModel->email);
    }
}