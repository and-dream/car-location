<?php

namespace App\Core;

class Database
{
    private static $host = 'localhost';
    private static $dbname = 'car_location';
    private static $username = 'root';
    private static $password = '';
    private static $connection; 
    
    public static function connect()
    {
        //  On vérifie si $connection a déjà été créée, si c'est pas le cas on la créé
        //  Design pattern Singleton : permet d'éviter d'appeler une ressource inutile
        if(!isset(self::$connection)){

            try
        {
        self::$connection = new \PDO(
            'mysql:host='. self::$host .';dbname=' . self::$dbname . ';',
            self::$username,
            self::$password,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
        );
        }
    
        catch (\PDOException $e){
            die ("Erreur connexion à la base de données" . $e->getMessage());
        }
    }

        }
                 
    
    public static function getConnection()
    {
        return self::$connection;
    }
}