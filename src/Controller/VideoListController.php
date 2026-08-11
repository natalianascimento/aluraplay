<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
   {
        
   } 

   public function processaRequisicao(): void
   {
        
        $videoList = $this->videoRepository->all();

        if (isset ($_GET['sucesso'])) {
            if ($_GET['sucesso'] == 1) {
                $mensagem = "Processo executado com sucesso.";
            } else {
                $mensagem = "Processo não executado.";
            }
        }
        require_once __DIR__ . '/../../view/video-list.php';
    } 
}