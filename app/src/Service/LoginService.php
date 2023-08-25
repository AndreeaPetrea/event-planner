<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
class LoginService
{

    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function checkUserLogin(string $email, string $password): ?User
    {
     return $this->userRepository->findOneBy(['email' => $email, 'password' => sha1($password)]);
    }

    public function createUserAccount(User $user):bool
    {
        $this->userRepository->add($user, true);
        return true;
    }

    public function searchUser(array $criteria): ?User
    {
        return $this->userRepository->findOneBy($criteria);
    }

    public function updateUser(User $user)
    {
        $this->userRepository->add($user, true);
    }
}
