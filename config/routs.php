<?php

use Alura\Mvc\Controller\AddVideoController;
use Alura\Mvc\Controller\EditController;
use Alura\Mvc\Controller\EditFormController;
use Alura\Mvc\Controller\FormController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\VideoListController;

return [
    '/' => VideoListController::class,
    '/enviar-video' => FormController::class,
    '/editar-video' => EditFormController::class,
    '/remover-video' => RemoveVideoController::class,
    '/novo-video' => AddVideoController::class,
    '/editado' => EditController::class
];