<?php

namespace App\Controller;

use App\Core\Database;

abstract class AbstractController
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
}