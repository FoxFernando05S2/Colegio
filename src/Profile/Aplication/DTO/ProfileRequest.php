<?php 

declare(strict_types=1);

namespace Src\Profile\Aplication\DTO;

class ProfileRequest
{

    public function __construct(
        public string $name,
        public string $apell,
        public int $age,
        public string $address,
        public int $userId,
    )
    {
    }

    

}