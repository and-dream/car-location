<?php

// Démarrer la session en premier
session_start();

use \App\Core\Autoloader;
use \App\Core\Router;
use \App\Core\Database;

require_once ('../src/Core/AutoLoader.php');

Autoloader::register();
Database::connect();
$router = new Router();
$router->execute();

