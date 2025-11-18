<?php 
namespace Alura\Mvc\Controller;

class FormController implements Controller
{
    public function __construct()
    {
    }
    public function processaRequisicao():void
    {
        require_once __DIR__ . "/../../views/form.php";
    }
}