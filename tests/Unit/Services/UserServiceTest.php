<?php

use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private $userMock;

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
        $userRepositoryMock = Mockery::mock(\App\Repositories\UserRepository::class);
        $userRepositoryMock->shouldReceive("find")->with(1)->andReturn($this->userMock);

        $userService = new \App\Services\UserService($userRepositoryMock);
        $actual = $userService->getUser(1);
        $this->assertEquals($this->userMock, $actual);
    }

    public function testAddUser(): void
    {
        $userRepositoryMock = Mockery::mock(\App\Repositories\UserRepository::class);
        $userRepositoryMock->shouldReceive("createUser")->with(["name" => "user_name", "email" => "user_name@gmail.com"])->andReturn($this->userMock);

        $userService = new \App\Services\UserService($userRepositoryMock);
        $actual = $userService->addUser(["name" => "user_name", "email" => "user_name@gmail.com"]);
        $this->assertEquals($this->userMock, $actual);
    }

    public function testGetUsers(): void
    {
        $userRepositoryMock = Mockery::mock(\App\Repositories\UserRepository::class);
        $userRepositoryMock->shouldReceive("findAll")->andReturn([$this->userMock]);

        $userService = new \App\Services\UserService($userRepositoryMock);
        $actual = $userService->getUsers();
        $this->assertEquals([$this->userMock], $actual);
    }
}
