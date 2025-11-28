<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormController implements RequestHandlerInterface
{
    use HtmlRendererTrait;
    public function __construct(private Engine $templates)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], $this->templates->render("form"));
    }
}