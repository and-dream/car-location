<?php

namespace App\Model;
use App\Model\AbstractModel;

class User extends AbstractModel
{
    public function saveUser($username, $email, $password)
    {
        $stmt = $this->pdo->prepare('INSERT INTO user (username,email, mdp) VALUES (:username, :email, :pswd)');
        
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':pswd' => $password
        ]);
    }


    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = :email');    
        $stmt->execute([':email' => $email]); 
        return $stmt->fetch();   
    }
}