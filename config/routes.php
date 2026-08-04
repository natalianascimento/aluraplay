<?php

return [
    'GET|/' => \Alura\Mvc\Controller\VideoListController::class,
    'GET|/novo-video' => \Alura\Mvc\Controller\FormVideoController::class,
    'POST|/novo-video' => \Alura\Mvc\Controller\AdicionaVideoController::class,
    'GET|/editar-video' => \Alura\Mvc\Controller\FormVideoController::class,
    'POST|/editar-video' => \Alura\Mvc\Controller\EditaVideoController::class,
    'GET|/remover-video' => \Alura\Mvc\Controller\RemoveVideoController::class,
];