<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveVideoController implements RequestHandlerInterface
{
    public function __construct(private VideoRepository $videorepository)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface{
        
        $parsedBody = $request->getParsedBody();
        $this->videorepository->removeVideo($parsedBody['id']);
        
        return new Response(302, ['Location' => '/']);
    }
}