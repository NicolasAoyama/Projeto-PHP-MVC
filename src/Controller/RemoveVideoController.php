<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class RemoveVideoController implements Controller
{
    public function __construct(private VideoRepository $videorepository)
    {
    }
    public function processaRequisicao(): void{
        $this->videorepository->removeVideo($_POST['id']);
        header('Location: /');

    }
}