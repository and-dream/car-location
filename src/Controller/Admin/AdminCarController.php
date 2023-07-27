<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Model\Car;

class AdminCarController extends AbstractController
{
    public function index()
    {
        //pour appeler une méthode dans model>car on va créer un objet de Car 
        $car = new Car();
        $car->getCars(); //getCars me retourne un tableau
        require_once '../templates/admin/cars.php';
    }
}