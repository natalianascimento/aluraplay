<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\User;
use Alura\Mvc\Repository\UserRepository;

class LoginController implements Controller
{
   public function __construct(private UserRepository $repository)
   {
        
   } 

   public function processaRequisicao(): void
   {
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $password = filter_input(INPUT_POST, 'password');
      $user = new User($email, $password);

      $userData = $this->repository->searchUserByEmail($user);
      $correctPassword = password_verify($user->password, $userData['password']);

      

      if ($correctPassword) {
        if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
        $this->repository->updateAlgorithm($user->password, $userData['id']);
        }

        $_SESSION['logado'] = true;
        header('Location: /');
        
      } else {
        header('Location: /login?sucesso=0');
        
      }
   }
}