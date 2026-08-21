<?php

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Repository\UserRepository;
use Alura\Mvc\Controller\Controller;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Controller\FormVideoController;
use Alura\Mvc\Controller\AdicionaVideoController;
use Alura\Mvc\Controller\EditaVideoController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Controller\LoginController;
use Alura\Mvc\Controller\LoginFormController;
use Alura\Mvc\Controller\AdicionaCapaVideo;

require_once __DIR__ . "/../vendor/autoload.php";

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute){
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerData = $routes["$httpMethod|$pathInfo"];
    $repository = new $controllerData["repository"]($pdo); 
    $controller = new $controllerData["class"]($repository);

} else {
    $controler = new Error404Controller();
    
}
/** @var Controller $controller */
$controller->processaRequisicao();