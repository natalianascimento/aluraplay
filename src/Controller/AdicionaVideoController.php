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

        $video = new Video($url, $titulo);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK){
            $fileName = uniqid('upload_') . "_" . $_FILES['image']['name'];
            $filePath = __DIR__ . '/../../public/img/uploads/' . $fileName;

            move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
            $video->setFilePath($fileName);
        }

        if ($this->repository->add($video) === false) {
            header('Location: /?sucesso=0');

        } else {
            header('Location: /?sucesso=1');
        }

   }

}