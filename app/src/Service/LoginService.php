<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
class LoginService
{

    public function __construct(private UserRepository $userRepository)
    {}

    public function checkUserLogin(string $email, string $password): ?User
    {
     return $this->userRepository->findOneBy(['email' => $email, 'password' => sha1($password)]);
    }

    public function createUserAccount(User $user): void
    {
        $this->userRepository->add($user, true);
    }

    public function searchUser(array $criteria): ?User
    {
        return $this->userRepository->findOneBy($criteria);
    }

    public function updateUser(User $user): void
    {
        $this->userRepository->add($user, true);
    }
}
