<?php 

declare(strict_types=1);

namespace Src\Profile\Infrastructure\Persistence;

use Src\Profile\Domain\Model\Profile;
use Src\Shader\Infrastructure\Database\Conexion;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;


class MySQLProfileRespository implements ProfileRepositoryInterface
{
    public function getAll(array $params = []): array
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();


        $query = 'SELECT id, name, apell, age, address, user_id FROM profiles';

        $filters = $this->buildFilters($params);
        if (!empty($filters['conditions'])) {
            $query .= ' WHERE ' . implode(' AND ', $filters['conditions']);
        }

        $statement = $pdo->prepare($query);
        foreach ($filters['bindings'] as $placeholder => $value) {
            $statement->bindValue($placeholder, $value);
        }

        $statement->execute();
        $results = $statement->fetchAll();

        $profiles = [];

        // foreach ($results as $row){
        //     $profiles[] = new Profile(
        //         id: $row['id'],
        //         name: $row['name'],
        //         apell: $row['apell'],
        //         age: $row['age'],
        //         address: $row['address'],
        //         user_id: $row['user_id']
        //     );
        // }
        return array_map(function($row) {
            return new Profile(
                id: $row['id'],
                name: $row['name'],
                apell: $row['apell'],
                age: $row['age'],
                address: $row['address'],
                user_id: $row['user_id']
            );
        },$results);
    }

    public function getById(int $profileId): ? Profile
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = 'SELECT id, name, apell, age, address, user_id FROM profiles WHERE id=:id';

        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $profileId, \PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();

        if($row){
            return new Profile(
                id: $row['id'],
                name: $row['name'],
                apell: $row['apell'],
                age: $row['age'],
                address: $row['address'],
                user_id: $row['user_id'],
            );
        }
        return null;
    }


    // public function register(string $name, string $apell, int $age, string $address, int $userId): void
    // {
    //     // Implementación para registrar un usuario
    // }

    // public function existsByUserId(int $userId): bool
    // {
    //     $conexion = new Conexion();
    //     $pdo = $conexion->getConexion();

    //     $query = 'SELECT COUNT(*) FROM profiles WHERE user_id = :userId';

    //     $statement = $pdo->prepare($query);
    //     $statement->bindValue(':userId', $userId, \PDO::PARAM_INT);
    //     $statement->execute();

    //     return $statement->fetchColumn() > 0;
    // }


    public function getByUserId(int $userId): ?Profile
    {

        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = "SELECT * FROM profiles WHERE user_id = :userId LIMIT 1";

        $statement = $this->$pdo->prepare($query);
        $statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $statement->execute();
        
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null; 
        }

        return new Profile(
            (int) $result['id'],
            $result['name'],
            $result['apell'],
            (int) $result['age'],
            $result['address'],
            (int) $result['user_id']
        );
    }

    public function register(string $name, string $apell, int $age, string $address, int $userId): void
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = 'INSERT INTO profiles (name, apell, age, address, user_id) VALUES (:name, :apell, :age, :address, :user_id)';

        $statement = $pdo->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':apell', $apell);
        $statement->bindValue(':age', $age, \PDO::PARAM_INT);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':user_id', $userId, \PDO::PARAM_INT);

        $statement->execute();
    }


    public function update(string $name, string $apell, int $age, string $address): void
    {
        // Implementación para actualizar el email de un usuario
    }

    public function delete(int $profileId): void
    {
        // Implementación para eliminar un usuario
    }


    private function buildFilters(array $params): array
    {
        $conditions = [];
        $bindings = [];
        $placeholderIndex = 1;

        foreach ($params as $key => $value) {
            // Definir los operadores permitidos y sus funciones
            $operator = '=';
            if (is_array($value)) {
                if (isset($value['operator']) && in_array($value['operator'], ['LIKE', '=', 'IN'])) {
                    $operator = $value['operator'];
                    $value = $value['value'];
                }
            }

            $placeholder = ':param' . $placeholderIndex++;
            switch ($operator) {
                case 'LIKE':
                    $conditions[] = "$key LIKE $placeholder";
                    $bindings[$placeholder] = "%$value%";
                    break;
                case 'IN':
                    $placeholders = implode(', ', array_fill(0, count($value), $placeholder));
                    $conditions[] = "$key IN ($placeholders)";
                    foreach ($value as $item) {
                        $bindings[$placeholder++] = $item;
                    }
                    break;
                case '=':
                default:
                    $conditions[] = "$key = $placeholder";
                    $bindings[$placeholder] = $value;
                    break;
            }
        }

        return ['conditions' => $conditions, 'bindings' => $bindings];
    }

}