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
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);


        $video = new Video($id, $url, $title);
        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/../../public/img/uploads" . $_FILES['image']['name'] );
            $video->setFilePath($_FILES['image']['name']);
        }
        $this->videoRepository->editVideo($video);
        header('Location: /');
    }

}