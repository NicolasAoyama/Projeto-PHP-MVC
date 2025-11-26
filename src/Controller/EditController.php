<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use finfo;

class EditController implements Controller
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            $this->addErrorMessage("Insira uma URL valida");
            header("Location: /editar-video?id={$id}");
            exit();
        }
        
        $title = filter_input(INPUT_POST, 'titulo');
            if ($title === false){
            $this->addErrorMessage("Insira um Titulo");
            header('Location: /editar-video');
            exit();
        }


        $video = $this->videoRepository->getID($id);
        $video = $this->videoRepository->formarObjeto($video);
        $videoPath = $video->getFilePath();
        $videoEditado = new Video($id, $url, $title, $videoPath);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            $fileTempName = uniqid() . "_" . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimetype = $finfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mimetype, "image/")){ 
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/../../public/img/uploads/" . $fileTempName );
                $videoEditado->setFilePath($fileTempName);
            }
        }
        
        $this->videoRepository->editVideo($videoEditado);
        header('Location: /');
    }

}