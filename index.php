<?php
require 'vendor/autoload.php';

use Core\Application;

$application = new Application(new \Core\Route(new \Core\Response()));
$application->boot();