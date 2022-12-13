<?php

namespace App\Models;

class User
{
    private $name, $email, $id;

    public function __construct(string $name, string $email, string $id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getEmail(): ?string  
    {
        return $this->email;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    static function buildFromApiModel(\stdClass $apiModel): self
    {
        return new User($apiModel->name, $apiModel->email, $apiModel->id);
    }
}