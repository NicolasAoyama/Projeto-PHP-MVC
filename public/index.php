<?php

use Alura\Mvc\Repository\UserRepository;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Factory\Psr17Factory;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "../../conexao.php";


$repository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

$routs = require_once __DIR__ . "/../config/routs.php";
$path_info = $_SERVER['PATH_INFO'] ?? "/";
$key = "$path_info";

session_start();
session_regenerate_id();
$isLoggin = str_starts_with($path_info, "/login");
if (!array_key_exists('logado', $_SESSION )&& !$isLoggin){
    header("location: /login");
    return;
}

    if(array_key_exists($key, $routs)){
        $controllerClass = $routs["$key"];
        if(str_starts_with($path_info, "/login")){
            $controller = new $controllerClass($userRepository);
        } else{
            $controller = new $controllerClass($repository);
        }
   
    }else{
        echo $variavel = "404 not found";
    }

    $psr17Factory = new Psr17Factory(); 

    $creator = new \Nyholm\Psr7Server\ServerRequestCreator(
        $psr17Factory, // ServerRequestFactory
        $psr17Factory, // UriFactory
        $psr17Factory, // UploadedFileFactory
        $psr17Factory  // StreamFactory
    );

    $request = $creator->fromGlobals();
    $response = $controller->handle($request);
    
    http_response_code($response->getStatusCode());
    foreach ($response->getHeaders() as $name => $values){
        foreach($values as $value){
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    echo $response->getBody();