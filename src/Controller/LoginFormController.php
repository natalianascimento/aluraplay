<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\User;
use Alura\Mvc\Repository\UserRepository;

class LoginFormController implements Controller
{
   public function __construct(private UserRepository $repository)
   {
        
   } 

   public function processaRequisicao(): void
   {
      if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
         header('Location: /');
         return;
      }
      require_once __DIR__ . '/../../view/login-form.php';
      
   }
}