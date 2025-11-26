<?php
namespace Alura\Mvc\Controller;
use Alura\Mvc\Controller\Controller;
use Alura\Mvc\Helper\HtmlRendererTrait;

class LoginController implements Controller
{
    use HtmlRendererTrait;
    public function processaRequisicao(): void
    {
        if($_SESSION['logado'] === true){
            header("Location: /");

        }
        echo $this->renderTemplate('login');

    } 
}