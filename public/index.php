<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\BootContainer;

$app = BootContainer::boot();
$app->load();