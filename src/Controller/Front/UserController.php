<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Model\User;
use App\Core\Session;



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
            // echo 'coucou';
            // die();
            //récupérer les données du formulaire
            $username = trim($_POST['username']);  //trim enlève les espaces au début et à la fin de la chaîne de caractères
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); // filter_var prend 2 paramètres
            $password = (trim($_POST['password'])); 

            // echo $password;
            // die();


            if(empty($username)){
                Session::setFlashMessage('Le champ pseudo est vide !', 'warning');
               // Création d'un message d'erreur sauvegardé en session
                header('Location:/car-location/inscription'); // redirection vers le formulaire
                exit();
            }

            if(empty($email)){
                Session::setFlashMessage('Veuillez renseigner un email !', 'warning');
               // Création d'un message d'erreur sauvegardé en session
                header('Location:/car-location/inscription'); // redirection vers le formulaire
                exit();
            }

            // var_dump($password);
            // die();
            if(empty($password)){
                Session::setFlashMessage('Veuillez définir un mot de passe !', 'warning');
               // Création d'un message d'erreur sauvegardé en session
                header('Location:/car-location/inscription'); // redirection vers le formulaire
                exit();
            } 
            // j'ai un objet qui a accès à toutes les méthodes
            $user = new User();

            // ça me retourne une ligne de la bdd si jamais l'email existe
            //on va vérifier si il existe
            if ($user->getUserByEmail($email)){
                Session::setFlashMessage('Cet email est déjà utilisé !', 'danger');
                header('Location:/car-location/inscription');
                exit();
            } 
            
            // crypter le mot de passe avant de l'envoyer en bdd
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            // s'il n'y a pas d'erreur il va aller jusqu'au bout et insérer en bdd
            $user->saveUser($username,$email,$password);          
            Session::setFlashMessage('Le formulaire a été envoyé', 'success');           
            header('Location:/car-location/');
            exit();
            // var_dump($_POST);
        } 
    }

    public function connexion()
    {
        require_once '../templates/front/form-connexion.php';
    }

    public function connect()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            // var_dump($password);

            if(empty ($email)){
                Session::setFlashMessage('Votre champ email est vide', 'warning');
                header('Location:/car-location/connexion');
                exit();
            }

            if(empty ($password)){
                Session::setFlashMessage('Votre champ mot de passe est vide', 'warning');
                header('Location:/car-location/connexion');
                exit();
            }
        }

        //créer une méthode pour récupérer les informations
        //on commence par créer un objet de User
        $user = new User();
        $user = $user->getUserByEmail($email);
        // var_dump($user);

        if($user === false){
           Session::setFlashMessage('Votre email n\'existe pas !', 'warning');
           header('Location: /car-location/connexion');
           exit(); 
        }

        if (password_verify($password, $user['mdp'])){
            Session::createSession($user); // on lui passe en paramètre un objet de type user
            Session::setFlashMessage('Vous etes connectés', 'success');
            header('Location: /car-location/');
            exit();
        } else {
            Session::setFlashMessage('Votre mot de passe est erroné', 'warning');
            header('Location: /car-location/connexion');
            exit();
        }
        // var_dump($user);
    }

    public function deconnexion()
    {
        session_destroy();
        unset($_SESSION);
        Session::setFlashMessage('Vous êtes déconnectés', 'success');
        header('Location: /car-location/');
        exit();
    }
}

