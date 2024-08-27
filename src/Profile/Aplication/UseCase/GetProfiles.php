<?php 

declare(strict_types=1);

namespace Src\Profile\Aplication\UseCase;

use Src\Profile\Aplication\DTO\ProfileResponse;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;

class GetProfiles
{

    public function __construct(
        private ProfileRepositoryInterface $profileRepository,
    ){
    }

    public function execute(array $params): array
    {
        $profiles = $this->profileRepository->getAll($params);

        return array_map(function($profile){
            return new ProfileResponse(
                id: $profile->getId(),
                name: $profile->getName(),
                apell: $profile->getApell(),
                age: $profile->getAge(),
                address: $profile->getAddress(),
                userId: $profile->getUserId(),
            );
        }, $profiles);
    }
}