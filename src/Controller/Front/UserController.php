<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Model\User;


class UserController extends AbstractController
{
    public function index(){
        require_once '../templates/front/form-inscription.php';
    }

    public function saveUser()
    {   
        // Verifier si le formulaire a été soumis
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {   
            //récupérer les données du formulaire
            $username = trim($_POST['username']);  //trim enlève les espaces au début et à la fin de la chaîne de caractères
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); // filter_var prend 2 paramètres
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // crypter le mot de passe

            if(empty($username)){
                $_SESSION['message'] = 'Le champ pseudo est vide'; // Création d'un message d'erreur sauvegardé en session
                header('Location:/car-location/inscription'); // redirection vers le formulaire
                exit();
            }
            $user = new User();
            $user->saveUser($username,$email,$password);
            // var_dump($_POST);
        }
    }
}

