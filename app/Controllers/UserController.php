<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Validations\UserValidation;
use Core\Request\Request;

class UserController
{
    public function __construct(private UserService $userService){}

    /**
     * @param Request $request
     * @return \App\Models\User
     */
    public function getUser(Request $request)
    {
        return $this->userService->getUser($request->input("id"));
    }

    public function addUser(Request $request, UserValidation $userValidation)
    {
        $data = $userValidation->validated();
        return $this->userService->adduser($data);
    }

    public function getUsers()
    {
        return $this->userService->getUsers();
    }
}