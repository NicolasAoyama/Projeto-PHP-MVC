<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;

class FormController implements Controller
{
    use HtmlRendererTrait;
    public function __construct()
    {
    }
    public function processaRequisicao():void
    {
        echo $this->renderTemplate("form");
    }
}