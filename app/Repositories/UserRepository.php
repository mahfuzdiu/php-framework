<?php

namespace App\Repositories;

use App\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(User::class));
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        $user = new User();
        $user->setName($data["name"]);
        $user->setEmail($data["email"]);
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }
}
