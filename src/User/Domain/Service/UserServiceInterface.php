<?php

declare(strict_types=1);

namespace Src\User\Domain\Service;

interface UserServiceInterface
{
    public function savePhoto(string $photoBase64): string;
}