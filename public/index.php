<?php

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Controller\FormVideoController;
use Alura\Mvc\Controller\AdicionaVideoController;
use Alura\Mvc\Controller\EditaVideoController;
use Alura\Mvc\Controller\RemoveVideoController;

require_once __DIR__ . "/../vendor/autoload.php";

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

if (!array_key_exists('PATH_INFO' ,$_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($videoRepository);
    $controller->processaRequisicao();

} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormVideoController($videoRepository);
        $controller->processaRequisicao();

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new AdicionaVideoController($videoRepository);
        $controller->processaRequisicao();

    }

} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new FormVideoController($videoRepository);
        $controller->processaRequisicao();

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditaVideoController($videoRepository);
        $controller->processaRequisicao();

    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new RemoveVideoController($videoRepository);
    $controller->processaRequisicao();
    
} else {
    http_response_code(404);

}