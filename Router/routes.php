<?php

use Src\Profile\Infrastructure\Controller\ProfileController;
use Src\User\Infrastructure\Controller\UserController;

// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap.php';
$userController = new UserController($container);
$profileController = new ProfileController($container);


return [
  'GET' => [
    'users' => function () use ($userController) {
      $userController->index();
    },
    'users/{id}' => function ($userId) use ($userController) {
      $userController->show((int)$userId);
    },
    'profiles' => function () use ($profileController) {
      $profileController->index1();
    },
    'profiles/{id}' => function ($profileId) use ($profileController) {
      $profileController->show1((int)$profileId);
    },

    'users/{id}/profile' => function ($profileId) use ($profileController) {
      $profileController->show1((int)$profileId);
    }
  ],


  'POST' => [
    'profiles' => function () use ($profileController) {
        $profileController->store();
      },
  ],
  
  'PUT' => [
    'posts' => function () {
      require __DIR__ . '/../src/controllers/updatePostController.php';
    },
  ],
  'DELETE' => [
    'posts' => function () {
      require __DIR__ . '/../src/controllers/deletePostController.php';
    },
  ],
];
