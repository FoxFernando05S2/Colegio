<?php

declare(strict_types=1);

use Core\Container;
use Src\User\Infrastructure\UserServiceProvider;
use Src\User\Domain\Service\UserServiceInterface;
use Src\User\Infrastructure\Service\S3UserService;
use Src\User\Domain\Repository\UserRepositoryInterface;
use Src\User\Infrastructure\Persistence\MySQLUserRespository;


use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Profile\Infrastructure\Persistence\MySQLProfileRespository;


require __DIR__ . '/vendor/autoload.php';

// Crear el contenedor
$container = new Container();

// Registrar los servicios de User como singletons
UserServiceProvider::register();

// Registrar en el contenedor las implementaciones de las interfaces usando los singletons del ServiceProvider
$container->set(UserRepositoryInterface::class, function() {
    return new MySQLUserRespository();
});

$container->set(UserServiceInterface::class, function() {
    return new S3UserService();
});


$container->set(ProfileRepositoryInterface::class, function() {
    return new MySQLProfileRespository();
});

return $container;