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

    public function updateCar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $name = trim($_POST['modele']); // la case modele dans le form qui correspond à l'attribut name=""
            $description = trim($_POST['description']);
            $price = trim($_POST['prix']);
            $id = $_POST['id'];
            // $image = ($_POST['image']);

            if(empty($name)){
                        Session::setFlashMessage('Veuillez entrer le nom du modèle !', 'warning');
                        header('Location:/car-location/backoffice/update-car/' . $id);
                        exit();
            }
            $car = new Car();
                        $car->updateCar($id,$name,$description,$price);
                        Session::setFlashMessage('Une voiture vient d\'être modifiée', 'success');
                        header('Location:/car-location/backoffice/cars');
                        exit();

        }else {
            header('Location:/car-location/backoffice/cars/');
            exit();
        }
    } 
}