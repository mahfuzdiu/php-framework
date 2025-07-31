<?php

use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    protected $userMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userMock = Mockery::mock(\App\Models\User::class);
        $this->userMock->shouldReceive("getId")->andReturn(1);
        $this->userMock->shouldReceive("getName")->andReturn("user_1");
        $this->userMock->shouldReceive("getEmail")->andReturn("user_1@gmail.com");
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGetUser(): void
    {
        $requestMock = Mockery::mock(\Core\Request\Request::class);
        $requestMock->shouldReceive("input")->with("id")->andReturn(1);

        $userServiceMock = Mockery::mock(\App\Services\UserService::class);
        $userServiceMock->shouldReceive("getUser")->with(1)->andReturn($this->userMock);

        $userController = new \App\Controllers\UserController($userServiceMock);
        $actual = $userController->getUser($requestMock);

        $this->assertEquals($this->userMock, $actual);
    }

    public function testAddUser(): void
    {
        $userValidationMock = Mockery::mock(\App\Validations\UserValidation::class);
        $userValidationMock->shouldReceive("validated")->andReturn(["name" => "user_name", "email" => "user_name@gmail.com"]);

        $userServiceMock = Mockery::mock(\App\Services\UserService::class);
        $userServiceMock->shouldReceive("adduser")->andReturn($this->userMock);

        $userController = new \App\Controllers\UserController($userServiceMock);
        $actual = $userController->addUser($userValidationMock);

        $this->assertEquals($this->userMock->getName(), $actual->getName());
    }

    public function testGetUsers(): void
    {
        $userServiceMock = Mockery::mock(\App\Services\UserService::class);
        $userServiceMock->shouldReceive("getUsers")->andReturn([$this->userMock]);

        $userController = new \App\Controllers\UserController($userServiceMock);
        $actual = $userController->getUsers();

        $this->assertEquals([$this->userMock], $actual);
    }
}
