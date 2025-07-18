<?php

require 'vendor/autoload.php';

use Core\BootContainer;

$app = BootContainer::boot();
$app->load();