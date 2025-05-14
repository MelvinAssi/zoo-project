<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class FirstAuthController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $hasher)
    {
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
    }

    #[Route('/api/firstlogin', name: 'api_firstlogin', methods: ['PUT'])]
    public function update(Request $request): Response
    {   

        $user = $this->getUser();
        
        if (!$user instanceof Users) {
            return new Response("Utilisateur non valide", 500);
        }

        if (!$user) {
            return new Response("Non authentifié", 401);
        }
        $data = json_decode($request->getContent(), true);

        if (empty($data['password'])) {
            return new Response("Mot de passe requis", 400);
        }

        $hashedPassword = $this->hasher->hashPassword($user, $data["password"]);
        $user->setPassword($hashedPassword);
        $user->setFirstLoginDone(true);

        $this->entityManager->flush();

       return new JsonResponse(['message' => 'Mot de passe mis à jour'], 200);
    }

    #[Route('/firstlogin', name: 'app_firstlogin', methods: ['GET'])]
    public function index(): Response
    {
        $response = $this->render('login/firstLoginPage.html.twig');
        $response->headers->set('X-Robots-Tag', 'noindex');
        return $response;
    }
}