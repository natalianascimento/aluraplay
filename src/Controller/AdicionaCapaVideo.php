<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;

class AdicionaCapaVideo
{
    public Video $videoEntity;
    public array $imageData;

    public function __construct($video, $image)
    {
        $this->videoEntity = $video;
        $this->imageData = $image;
        $this->processaRequisicao();
    } 

    private function processaRequisicao(): void
    {
        // Validar o tipo MIME real usando os bytes do arquivo (Magic Numbers)
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($this->imageData['tmp_name']);
        
        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!array_key_exists($mimeType, $allowedMimeTypes)) {
            throw new \Exception('Formato de imagem inválido. Apenas JPG, PNG e WEBP são permitidos.');
        }

        // Gerar um nome totalmente seguro
        $extensao = $allowedMimeTypes[$mimeType];
        $fileName = uniqid('upload_') . '.' . $extensao;
        
        $uploadDir = __DIR__ . '/../../public/img/uploads/';
        
        // Garantir que o diretório existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePath = $uploadDir . $fileName;

        // Mover o arquivo com segurança
        if (!move_uploaded_file($this->imageData['tmp_name'], $filePath)) {
            throw new \Exception('Falha ao salvar o arquivo no servidor.');
        }

        $this->videoEntity->setFilePath($fileName);
    }
}