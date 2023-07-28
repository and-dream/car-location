<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Model\Car;
use App\Core\Session;

class AdminCarController extends AbstractController
{
    public function index()
    {
        //pour appeler une méthode dans model>car on va créer un objet de Car 
        $car = new Car();
        $cars = $car->getCars(); //getCars me retourne un tableau
        require_once '../templates/admin/cars.php';
    }

    public function carForm($params) // cette fonction quand on l'appelle il faut qu'on lui passe un tableau avec un paramètre ID
    {
        // echo $params['id'];
        // $id = $params['id'];
        $car = new Car();
        $carDetails = $car->getCarById($params['id']);
        // var_dump($carDetails);
        require_once '../templates/admin/car-form.php';
    }

    public function updateCar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['modele']); // la case modele dans le form qui correspond à l'attribut name=""
            $description = trim($_POST['description']);
            $price = trim($_POST['prix']);
            $id = $_POST['id'];

            // var_dump($_FILES['fichier']); // attribut name dans le formulaire
            // die();
            // on va accéder à une superglobale pour gérer l'image
            if (empty($name)) {
                Session::setFlashMessage('Veuillez entrer le nom du modèle !', 'warning');
                header('Location:/car-location/backoffice/update-car/' . $id);
                exit();
            }

            if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
                // on enregistre dans un tableau les formats d'images autorisés
                $allowed = ['jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif'];
                $fileName = $_FILES['fichier']['name'];
                $fileType = $_FILES['fichier']['type'];
                $fileSize = $_FILES['fichier']['size'];

                $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                if (!array_key_exists($extension, $allowed)) {
                    Session::setFlashMessage('Le format de votre fichier n\'est pas correct !', 'warning');
                    header('Location:/car-location/backoffice/update-car/' . $id);
                    exit();
                }

                $maxsize = 5 * 1024 * 1024; // 5 correspond à 5Mo

                if ($fileSize > $maxsize) {
                    Session::setFlashMessage('Le format de votre fichier est trop volumineux !', 'warning');
                    header('Location:/car-location/backoffice/update-car/' . $id);
                    exit();
                }

                if (in_array($fileType, $allowed)) {
                    if (file_exists('./img/upload/' . $fileName)) {    //on vérifie si ce fichier existe déjà dans le dossier image .img
                        Session::setFlashMessage('Le fichier a déjà été téléchargé !', 'warning');
                        header('Location:/car-location/backoffice/update-car/' . $id);
                        exit();
                    } else {
                        move_uploaded_file($_FILES['fichier']['tmp_name'], './img/upload/' . $_FILES['fichier']['name']);
                    }
                }
            } else {
                Session::setFlashMessage('Une erreur dans le fichier image s\'est produite, veuillez recommencer !', 'warning');
                header('Location:/car-location/backoffice/update-car/' . $id);
                exit();
            }

            $car = new Car();
            $car->updateCar($id, $name, $description, $price, $fileName);
            Session::setFlashMessage('Une voiture vient d\'être modifiée', 'success');
            header('Location:/car-location/backoffice/cars');
            exit();
        } else {
            header('Location:/car-location/backoffice/cars/');
            exit();
        }
    }
}
