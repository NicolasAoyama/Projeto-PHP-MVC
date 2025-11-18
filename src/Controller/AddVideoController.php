<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class AddVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao():void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        if ($url === false){
            header('Location: /');
            exit();
        }
        $title = filter_input(INPUT_POST, 'titulo');
            if ($title === false){
            header('Location: /');
            exit();
        }
        $this->videoRepository->addVideo(new Video(null, $url, $title));
        header('Location: /');
    }
}