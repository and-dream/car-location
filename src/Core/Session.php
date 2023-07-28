<?php

namespace App\Core;
use App\Model\User;


//on a une classe qui va gérer la gestion/création des messages
class Session 
{
    public static function setFlashMessage(string $message, string $type)
    {
        $_SESSION['message'] = // elle va sauvegarder dans le tableau superglobale $_SESSION le message qu'on va lui passer en paramètre dans la case message
    
        '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . $message .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

    }

    //afficher la variable $message mais on va vérifier d'abord si elle existe
    public static function getMessage(){
        if (isset ($_SESSION['message'])){
            echo $_SESSION['message'] ;          
            unset($_SESSION['message']);
        }
    }

    public static function createSession(array $user){
        $_SESSION['LOGGED_USERNAME'] = $user['username'];
        $_SESSION['LOGGED_ID'] =$user['id'];     
        if($user['admin'] === true){
        $_SESSION['LOGGED_ADMIN'] = true;

        }

    }
}