<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use finfo;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $id = filter_var($parsedBody['id'], FILTER_VALIDATE_INT);

        $url = filter_var($parsedBody['url'], FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            $this->addErrorMessage("Insira uma URL valida");
            return new Response(302, [
                'Location' => "/editar-video?id={$id}"
            ]);
        }
        
        $title = filter_input(INPUT_POST, 'titulo');
            if ($title === ""){
            $this->addErrorMessage("Insira um Titulo");
            return new Response(302, [
                'Location' => "/editar-video?id={$id}"
            ]);
        }


        $video = $this->videoRepository->getID($id);
        $video = $this->videoRepository->formarObjeto($video);
        $videoPath = $video->getFilePath();
        $videoEditado = new Video($id, $url, $title, $videoPath);

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
                $videoEditado->setFilePath($safeFileName);
            }
        }
        
        $this->videoRepository->editVideo($videoEditado);
        return new Response(302, [
                'Location' => "/"
            ]);

    }

}