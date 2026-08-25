<?php

return [
    'GET|/' => ['class' => \Alura\Mvc\Controller\VideoListController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'GET|/novo-video' => ['class' => \Alura\Mvc\Controller\FormVideoController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'POST|/novo-video' => ['class' => \Alura\Mvc\Controller\AdicionaVideoController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'GET|/editar-video' => ['class' => \Alura\Mvc\Controller\FormVideoController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'POST|/editar-video' => ['class' => \Alura\Mvc\Controller\EditaVideoController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'GET|/remover-video' => ['class' => \Alura\Mvc\Controller\RemoveVideoController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class],
    'GET|/login' => ['class' => \Alura\Mvc\Controller\LoginFormController::class, 'repository' => \Alura\Mvc\Repository\UserRepository::class],
    'POST|/login' => ['class' => \Alura\Mvc\Controller\LoginController::class, 'repository' => \Alura\Mvc\Repository\UserRepository::class],
    'GET|/logout' => ['class' => \Alura\Mvc\Controller\LogoutController::class, 'repository' => \Alura\Mvc\Repository\UserRepository::class],
    'GET|/remove-capa' => ['class' => \Alura\Mvc\Controller\RemoveCapaController::class, 'repository' => \Alura\Mvc\Repository\VideoRepository::class]
];