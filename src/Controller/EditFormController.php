<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class EditFormController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao():void
    {
        $idVideo = $_GET['id'];
        $videoEdit = $this->videoRepository->getID($idVideo);
        require_once __DIR__ . "/../../views/editForm.php";    
    }
}