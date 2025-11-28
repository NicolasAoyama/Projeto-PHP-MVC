<?php
namespace Alura\Mvc\Config;

use Alura\Mvc\Repository\VideoRepository;
use DI\ContainerBuilder;
use League\Plates\Engine;
use PDO;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function(): PDO{
        return new PDO('mysql:host=localhost;dbname=aluraplay', 'root', 'Saladasemsal');
    },
    Engine::class => function(){
        $templatePath = __DIR__ . "/../views";
        return new Engine($templatePath);
    }
    
]);
$container = $builder->build(); 

return $container;