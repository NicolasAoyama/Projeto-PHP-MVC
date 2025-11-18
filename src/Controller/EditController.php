<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class EditController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao(): void
    {
        $this->videoRepository->editVideo(new Video($_POST['id'], $_POST['url'], $_POST['titulo'] ));
        header('Location: /');
    }

}