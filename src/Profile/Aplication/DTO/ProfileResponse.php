<?php 

declare(strict_types=1);
namespace Src\Profile\Aplication\DTO;

class ProfileResponse
{

    public function __construct(
        public int $id,
        public string $name,
        public string $apell,
        public int $age,
        public string $address,
        public int $userId,
    ){
    }
}