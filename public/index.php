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

if (!array_key_exists('PATH_INFO' ,$_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($videoRepository);

} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormVideoController($videoRepository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new AdicionaVideoController($videoRepository);

    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormVideoController($videoRepository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditaVideoController($videoRepository);

    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new RemoveVideoController($videoRepository);
    
} else {
    $controller = new Error404Controller($videoRepository);
    
}
/** @var \Alura\Mvc\Controller\Controller $controller */
$controller->processaRequisicao();