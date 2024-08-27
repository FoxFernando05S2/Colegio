<?php

declare(strict_types=1);

namespace Src\Profile\Infrastucture;

use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Profile\Infrastructure\Persistence\MySQLProfileRespository;

class ProfileServiceProvider
{
    private static array $instances = [];

    public static function register(): void
    {
        // Registrar el singleton para UserRepositoryInterface
        self::$instances[ProfileRepositoryInterface::class] = function () {
            return new MySQLProfileRespository();
        };

    }

    public static function get(string $interface)
    {
        if (!isset(self::$instances[$interface])) {
            throw new \Exception("No instance found for {$interface}");
        }

        // Llamar al closure para obtener la instancia
        return call_user_func(self::$instances[$interface]);
    }
}