<?php

declare(strict_types=1);

namespace Src\Profile\Aplication\UseCase;

use Src\Profile\Aplication\DTO\ProfileResponse;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Profile\Domain\Exception\ProfileNotFoundException;


class GetProfile
{

    public function __construct(
        private ProfileRepositoryInterface $profileRepository,
    ){
    }

    public function execute(int $profileId): ProfileResponse
    {
        $profile = $this->profileRepository->getById($profileId);

        if(!$profile)

            throw new ProfileNotFoundException();

        return new ProfileResponse(
            id: $profile->getId(),
            name: $profile->getName(),
            apell: $profile->getApell(),
            age: $profile->getAge(),
            address: $profile->getAddress(),
            userId: $profile->getUserId(),
        );
        
    }
}