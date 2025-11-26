<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use finfo;

class AddVideoController implements Controller
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao():void
    {

        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            $this->addErrorMessage("Por favor insira uma URL valida");
            header('Location: /enviar-video');
            exit();
        }
        $title = filter_input(INPUT_POST, 'titulo');
            if ($title === false){
            $this->addErrorMessage("Insira um Titulo");
            header('Location: /enviar-video');
            exit();
        }
        $video = new Video(null, $url, $title);
        
        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            
            $fileTempName = uniqid() . "_" . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimetype = $finfo->file($_FILES['image']['tmp_name']);    
            
            if(str_starts_with($mimetype, "image/")){
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/../../public/img/uploads/" . $fileTempName );
                $video->setFilePath($fileTempName);
            }
    }
        
        $this->videoRepository->addVideo($video);
        header('Location: /');
    }
}