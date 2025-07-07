<?php
require 'vendor/autoload.php';

use Core\Application;

$container = new DI\Container();
$application = new Application($container);
$application->boot();