<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormController implements RequestHandlerInterface
{
    use HtmlRendererTrait;
    public function __construct()
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], $this->renderTemplate("form"));
    }
}