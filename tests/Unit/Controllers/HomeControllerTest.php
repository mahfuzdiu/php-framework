<?php

use App\Controllers\HomeController;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testHome(): void
    {
        $homeController = new HomeController();
        $actual = $homeController->home();
        $this->assertEquals("Welcome to home", $actual);
    }
}
