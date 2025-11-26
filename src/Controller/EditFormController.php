<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;

class EditFormController implements Controller
{
    use HtmlRendererTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao():void
    {
        $idVideo = $_GET['id'];
        $videoEdit = $this->videoRepository->getID($idVideo);

        echo $this->renderTemplate('editForm', ['videoEdit' => $videoEdit]);

    }
}