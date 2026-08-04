<?php

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\Controller;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Controller\FormVideoController;
use Alura\Mvc\Controller\AdicionaVideoController;
use Alura\Mvc\Controller\EditaVideoController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\Error404Controller;

require_once __DIR__ . "/../vendor/autoload.php";

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);

} else {
    $controler = new Error404Controller();
    
}
/** @var Controller $controller */
$controller->processaRequisicao();