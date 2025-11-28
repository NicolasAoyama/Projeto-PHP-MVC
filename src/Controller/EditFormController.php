<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditFormController implements RequestHandlerInterface
{
    use HtmlRendererTrait;
    public function __construct(private VideoRepository $videoRepository, private Engine $templates)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $idVideo = $queryParams['id'];
        $videoEdit = $this->videoRepository->getID($idVideo);

        return new Response(200, [], $this->templates->render('editForm', ['videoEdit' => $videoEdit]));  
    }
}