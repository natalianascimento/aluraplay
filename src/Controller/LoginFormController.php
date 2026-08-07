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
      require_once __DIR__ . '/../../view/login-form.php';
      
   }
}