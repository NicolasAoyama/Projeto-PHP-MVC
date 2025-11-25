<?php
namespace Alura\Mvc\Controller;
use Alura\Mvc\Controller\Controller;

class LoginController implements Controller
{
    public function processaRequisicao(): void
    {
        if($_SESSION['logado'] === true){
            header("Location: /");

        }
        require_once __DIR__ . "/../../views/login.php";
    } 
}