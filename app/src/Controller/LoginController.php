<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LoginService;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="userLogin", methods={"POST", "GET"})
     */
    public function login(LoginService $loginService, Request $request): JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if (!$email || !$password) {
            return $this->json(['message' => 'Please insert your email and password']);
        }

        $currentUser = $loginService->checkUserLogin($email, $password);

        if($currentUser) {
            return $this->json([
                'message' => 'You are successfully logged in',
                'userName' => $currentUser->getName()
            ]);
        }

        return $this->json([
            'message' => 'The email-password combination do not work. Please try again later'
        ]);
    }

    /**
     * @Route("/register", name="userRegister", methods={"POST", "GET"})
     */
    public function register(LoginService $loginService, Request $request): JsonResponse
    {
        $user = (new User())
            ->setEmail($request->get('email'))
            ->setName($request->get('name'))
            ->setSurname($request->get('surname'))
            ->setPhoneNo($request->get('phone'))
            ->setPassword(sha1($request->get('password')))
            ->setUserAccessId($request->get('userAccessId'))
            ->setPartnerEmail($request->get('partnerEmail'));

       $loginService->createUserAccount($user);

        return $this->json([
            'message' => 'Account has been created. Please login!',
        ]);
    }

    /**
     * @Route("/reset-password", name="resetPassword", methods={"POST", "GET"})
     */
    public function passwordReset(LoginService $loginService, Request $request): JsonResponse
    {
        $email = $request->get('email');
        $currentPassword = $request->get('currentPassword');
        $updatedPassword = $request->get('updatedPassword');

        if (!$email || !$currentPassword || !$updatedPassword) {
            return $this->json([
                'message' => 'Please provide an email, current password and the new password!',
            ]);
        }

        $foundUser = $loginService->searchUser(['email' => $email, 'password' => sha1($currentPassword)]);

        if (!$foundUser) {
            return $this->json([
                'message' => 'User with the combination of password-email does not exist!',
            ]);
        }

        $foundUser->setPassword(sha1($updatedPassword));
        $loginService->updateUser($foundUser);

        return $this->json([
            'message' => 'Password has been updated!',
        ]);
    }
}
