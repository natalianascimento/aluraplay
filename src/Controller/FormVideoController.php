<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class FormVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
   {
        
   } 

   public function processaRequisicao(): void
   {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $video = [
            'url' => '',
            'title' => '',
        ];

        if ($id !== false && $id !== NULL) {
            $video = $this->repository->search($id);
        }

        require_once __DIR__ . '/../../view/video-form.php';
   }

}