<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(private UserRepository $userRepository){}

    /**
     * @param $id
     * @return User
     */
    public function getUser($id): User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param array $data
     * @return User
     */
    public function addUser(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->userRepository->findAll();
    }
}