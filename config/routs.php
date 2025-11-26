<?php

use Alura\Mvc\Controller\AddVideoController;
use Alura\Mvc\Controller\EditController;
use Alura\Mvc\Controller\EditFormController;
use Alura\Mvc\Controller\FormController;
use Alura\Mvc\Controller\JsonVideoListController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Controller\LoginController;
use Alura\Mvc\Controller\LoginValidationController;
use Alura\Mvc\Controller\LogoutController;
use Alura\Mvc\Controller\NewJsonVideoController;

return [
    '/' => VideoListController::class,
    '/enviar-video' => FormController::class,
    '/editar-video' => EditFormController::class,
    '/remover-video' => RemoveVideoController::class,
    '/novo-video' => AddVideoController::class,
    '/editado' => EditController::class,
    '/login' => LoginController::class,
    '/login/auth' => LoginValidationController::class,
    '/logout' => LogoutController::class,
    '/videos-json' => JsonVideoListController::class,
    '/videos' => NewJsonVideoController::class


];