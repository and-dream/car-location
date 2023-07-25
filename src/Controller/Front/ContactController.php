<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;

class ContactController extends AbstractController
{

    public function index($params){
        echo $params['id'];  
    }

    public function saveForm(){

    }
}