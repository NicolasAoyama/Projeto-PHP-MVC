<?php

use Alura\Mvc\Controller\AddVideoController;
use Alura\Mvc\Controller\EditController;
use Alura\Mvc\Controller\EditFormController;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Controller\FormController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "../../conexao.php";

$repository = new VideoRepository($pdo);

$routs = require_once __DIR__ . "/../config/routs.php";
$path_info = $_SERVER['PATH_INFO'] ?? "/";
$key = "$path_info";
    if(array_key_exists($key, $routs)){
    $controllerClass = $routs["$path_info"];

    $controller = new $controllerClass($repository);
}else{
    echo $variavel = "404 not found";
}
$controller->processaRequisicao();
