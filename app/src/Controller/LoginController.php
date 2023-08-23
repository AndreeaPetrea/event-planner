<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="userLogin", methods={"POST", "GET"})
     */
    public function login(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
        ]);
    }

    /**
     * @Route("/register", name="userRegister", methods={"POST", "GET"})
     */
    public function register(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Account has been created. Please login!',
        ]);
    }

    /**
     * @Route("/reset-password", name="resetPassword", methods={"POST", "GET"})
     */
    public function passwordReset(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Password resetted successfully!',
        ]);
    }
}
