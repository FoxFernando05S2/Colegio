<?php 

declare(strict_types=1);

namespace Src\Profile\Domain\Repository;

use Src\Profile\Domain\Model\Profile;

interface ProfileRepositoryInterface{

    public function getAll(array $params=[]):array;

    public function getById(int $profileId): ?Profile;

    public function register(string $name, string $apell, int $age, string $address, int $userId): void;

    public function update(string $name, string $apell, int $age, string $address):void;

    public function getByUserId(int $userId): ?Profile;

    public function delete (int $profileId):void;

}