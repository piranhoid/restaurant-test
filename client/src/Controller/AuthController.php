<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/register", methods={"POST"}, name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['username'];
        $plainPassword = $data['password'];

        if (empty($email) || empty($plainPassword)) {
            throw new NotFoundHttpException('Missing some parameters');
        }

        $this->userRepository->saveUser($email, $plainPassword);

        return new Response(['status' => 'User created!'], Response::HTTP_CREATED);
    }
}
