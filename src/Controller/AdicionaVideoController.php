<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class AdicionaVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
   {
        
   } 

   public function processaRequisicao(): void
   {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        if ($this->repository->add(new Video($url, $titulo)) === false) {
            header('Location: /?sucesso=0');

        } else {
            header('Location: /?sucesso=1');
        }

   }

}