<?php

declare(strict_types=1);

namespace Src\User\Aplication\UseCase;

use Src\User\Aplication\DTO\UserPhotoRequest;
use Src\User\Domain\Service\UserServiceInterface;
use Src\User\Domain\Exception\UserNotFoundException;
use Src\User\Domain\Repository\UserRepositoryInterface;

class UpdateUserPhoto
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserServiceInterface $userService,
    ) {
    }

    // public function execute(UserPhotoRequest $request): void
    // {
    //     $user = $this->userRepository->getById($request->userId);

    //     if (!$user) throw new UserNotFoundException();

    //     $newPhotoUrl = $this->userService->savePhoto($request->photoBase64);

    //     $this->userRepository->updatePhotoUrl($request->userId, $newPhotoUrl);
    // }
}