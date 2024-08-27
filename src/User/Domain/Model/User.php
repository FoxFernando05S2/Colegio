<?php

declare(strict_types=1);

namespace Src\User\Domain\Model;

class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $password,
        // private ?string $photoUrl,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    // public function getPhotoUrl(): ?string
    // {
    //     return $this->photoUrl;
    // }
}