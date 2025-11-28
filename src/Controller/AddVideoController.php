<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use finfo;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository, Engine $templates)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        //Recebendo e verificando variaveis para adicionar o video
        $parsedBody = $request->getParsedBody();
        $url = filter_var($parsedBody['url'], FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            $this->addErrorMessage("Por favor insira uma URL valida");
            return new Response (302, ['Location' => '/enviar-video']);
        }
        $title = filter_var($parsedBody['titulo']);
            if ($title === ""){
            $this->addErrorMessage("Insira um Titulo");
            return new Response (302, ['Location' => '/enviar-video']);
        }
        $video = new Video(null, $url, $title);
        
        //Adicionando imagem ao video
        $files = $request->getUploadedFiles();
        $uploadedImage = $files['image'];
        if($uploadedImage->getError() === UPLOAD_ERR_OK){
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetaData('uri');
            $mimetype = $finfo->file($tmpFile);    
            
            if(str_starts_with($mimetype, "image/")){
                $safeFileName = uniqid() . "_" . pathinfo($uploadedImage->getClientFileName(), PATHINFO_BASENAME);
                $uploadedImage->moveTo( __DIR__ . "/../../public/img/uploads/" . $safeFileName);
                $video->setFilePath($safeFileName);
            }
    }
        
        $this->videoRepository->addVideo($video);
        return new Response (302, ['Location' => '/']);
    }
}