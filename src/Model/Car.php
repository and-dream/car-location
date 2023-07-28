<?php

namespace App\Model;
use App\Model\AbstractModel;

    class Car extends AbstractModel
    {
        public function getCars()
        {
           $stmt = $this->pdo->prepare('SELECT * FROM car');
           $stmt->execute();
           return $stmt->fetchAll();
        }

        public function getCarById($id){
            $stmt = $this->pdo->prepare('SELECT * FROM car WHERE id = :id');
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        }

        public function updateCar(int $id, string $name, string $description,float $price): void
        {
            $stmt = $this->pdo->prepare('UPDATE car SET name = :name, description = :description, price = :price WHERE id = :id');
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':id' => $id
            ]);
        }
    }