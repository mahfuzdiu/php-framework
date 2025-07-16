<?php
require 'vendor/autoload.php';

use Core\Application;
use Core\Exception\GlobalException;


$container = new DI\Container();
$globalExceptionHandler = $container->get(GlobalException::class);
$globalExceptionHandler->registerErrorHandler();

$app = $container->get(Application::class);
$app->boot();