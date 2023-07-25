<?php

namespace App\Core;

use App\Controller\Front\HomeController;
use App\Controller\Front\ContactController;
use App\Controller\Front\CarController;

require_once '../src/Controller/Front/HomeController.php';
require_once '../src/Controller/Front/ContactController.php';
require_once '../src/Controller/Front/CarController.php';


class Router {
    /**
     *
     * @var array
     */
    private array $routes;  // tableau associatif pour stocker les routes et les fonctions associés

    /**
     *
     * @var [type]
     */
    private $currentController; // stocke le controller actuel pour l'action demandée
    
    public function __construct()
    {
        // ajoute des routes dans le constructeur, donc à l'initialisation de l'objet
        $this->add_route('/', function(){
            $this->currentController = new HomeController(); // créé une instance du controller d'accueil
            $this->currentController->index(); // appelle la method index du controleur d'accueil
        });
        // on ajoute une route pour la page contact avec un paramètre id 
        $this->add_route('/contact/{id}', function($params){ // on peut passer les éventuels paramètres à la fonction
            $this->currentController = new ContactController();
            $this->currentController->index($params);
        });
        $this->add_route('/contact/form', function($params){
            $this->currentController = new ContactController();
            $this->currentController->saveForm($params);
        });

        $this->add_route('/car/{id}', function($params){
            $this->currentController = new CarController();
            $this->currentController->index($params);
        });
    }

    private function add_route(string $route, callable $closure)
    {
        // on convertit la route en une expression régulière pour une correspondance flexible en url et paramètre
        $pattern = str_replace('/', '\/', $route); // échappe les barres obliques pour la regex
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern); // remplace les parties entre accolades par des groupes de capture (parametre)
        $pattern='/^' . $pattern . '$/'; //ajouter les délimiteurs de début et de fin de la regex
        // var_dump($pattern);
        $this->routes[$pattern] = $closure; // Stocke la regex de la route et la fonction associée dans le tableau des routes
    }

    public function execute()
    {
        $requestUri = $_SERVER['REQUEST_URI']; // récupère l'URL de la requête
        $finalPath = str_replace('/car-location', '', $requestUri); // supprime le dossier racine pour obtenir le chemin final
        // var_dump($finalPath);
        
        foreach ($this->routes as $key => $closure)
        {
            if(preg_match($key, $finalPath, $matches)){
                array_shift($matches);
                $closure($matches); // appelle la fonction associée à la route avec els éventuels paramètres capturés
                return;
            }
        }
        require_once '../templates/error-404.php';
    }
}