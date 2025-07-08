<?php
require 'vendor/autoload.php';

use Core\Application;

$container = new DI\Container();
$app = $container->get(Application::class);
$app->boot();