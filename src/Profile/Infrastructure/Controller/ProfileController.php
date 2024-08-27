<?php

declare(strict_types=1);

namespace Src\Profile\Infrastructure\Controller;

use Core\Container;
use Src\Profile\Aplication\DTO\ProfileRequest;
use Src\Profile\Aplication\UseCase\GetProfile;
use Src\Profile\Aplication\UseCase\GetProfiles;
use Src\Profile\Aplication\UseCase\RegisterProfile;
use Src\Shader\Infrastructure\Utils\QueryParams;

class ProfileController
{

    public function __construct(
        private Container $container,
    ){

    }

    public function index1()
    {
        $name = QueryParams::query('name');
        $params['name']=[
            'operator' => 'LIKE',
            'value' => $name,
        ];

        $getProfiles = $this->container->get(GetProfiles::class);
        $profiles = $getProfiles->execute($params);
        echo json_encode($profiles);
    }

    public function show1(int $profileId)
    {
        $getProfile = $this->container->get(GetProfile::class);
        $profile = $getProfile->execute($profileId);
        echo json_encode($profile);
    }


    public function store()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $registerProfile = $this->container->get(RegisterProfile::class);
        

        $registerProfiles= new ProfileRequest(
            name: $data['name'],
            apell: $data['apell'],
            age: (int)$data['age'],
            address: $data['address'],
            userId: (int)$data['user_id']
        );

        

        $registerProfile->execute($registerProfiles);

        echo json_encode(
            [
                'success'=>true,
                'message'=>'User registered successfully',
            ]
        );

        // // Obtener los datos enviados en el cuerpo de la petición
        // 

        // // Validar que todos los campos necesarios están presentes
        // if (!isset($data['name'], $data['apell'], $data['age'], $data['address'], $data['user_id'])) {
        //     http_response_code(400);
        //     echo json_encode(['error' => 'Todos los campos son obligatorios.']);
        //     return;
        // }

        // // Ejecutar el caso de uso para registrar el perfil
        // $registerProfile = $this->container->get(RegisterProfile::class);
        
        // try {
            
        //     http_response_code(201);
        //     echo json_encode(['success' => 'Perfil registrado exitosamente.']);
        // } catch (\Exception $e) {
        //     http_response_code(400);
        //     echo json_encode(['error' => $e->getMessage()]);
        // }
    }

}