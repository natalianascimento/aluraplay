<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class RemoveVideoController implements Controller
{
   public function __construct(private VideoRepository $repository)
   {
        
   } 

   public function processaRequisicao(): void
   {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $video = $this->repository->remove($id);

        if ($video === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
   }
}