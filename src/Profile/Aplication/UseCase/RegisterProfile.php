<?php

declare(strict_types=1);

namespace Src\Profile\Aplication\UseCase;

use Src\Profile\Aplication\DTO\ProfileRequest;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Profile\Domain\Exception\ProfileAlreadyExistsException;
use Src\Profile\Domain\Model\Profile;


class RegisterProfile
{

    public function __construct(
        private ProfileRepositoryInterface $profileRepository,
        
    ){

    }

    // public function execute(ProfileRequest $request): void{
        
    //     $this->profileRepository->register($request->name, $request->apell, $request->age, $request->address, $request->userId);
    // }

    public function execute(ProfileRequest $request): void
    {
    
        // $existingProfile = $this->profileRepository->getByUserId($request->userId);

        // if ($existingProfile !== null) {
        //     throw new ProfileAlreadyExistsException('A profile with this user ID already exists.');
        // }

        $this->profileRepository->register(
            $request->name,
            $request->apell,
            $request->age,
            $request->address,
            $request->userId
        );
    }

}