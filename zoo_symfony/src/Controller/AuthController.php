<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

class AuthController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(EntityManagerInterface $entityManager, JWTTokenManagerInterface $jwtManager)
    {
        $this->entityManager = $entityManager;
        $this->jwtManager = $jwtManager;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request)
    {
        // Récupération des données envoyées par le client
        $data = json_decode($request->getContent(), true);

        // Recherche de l'utilisateur par l'email
        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $data['email']]);

        if (!$user) {
            return new Response('Utilisateur non trouvé', 404);
        }

        // Vérification du mot de passe
        if (!password_verify($data['password'], $user->getPassword())) {
            return new Response('Mot de passe incorrect', 401);
        }
        // Créer un jeton JWT
        $token = $this->jwtManager->create($user);

        // Créer le cookie avec le jeton
        $cookie = Cookie::create('BEARER')
            ->withValue($token)
            ->withHttpOnly(false)
            ->withSecure(false) // À changer en `true` en production
            ->withPath('/')
            ->withExpires(time() + 3600); // 1h
        // Réponse avec message de succès
        $response = new Response(json_encode(['message' => 'Connecté avec succès ']));
        $response->headers->set('Content-Type', 'application/json');

        // Ajouter le cookie à la réponse
        $response->headers->setCookie($cookie);

        return $response;
    }

    #[Route('/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): Response
    {
        $cookie = Cookie::create('BEARER')->withValue('')->withExpires(time() - 3600);
        $response = new Response(json_encode(['message' => 'Déconnecté avec succès']));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->setCookie($cookie);

        return $response;
    }

    #[Route('/api/protected', name: 'protected_route', methods: ['POST'])]
    public function protected(Request $request, JWTEncoderInterface $jwtEncoder): JsonResponse
    {
        $token = $request->cookies->get('BEARER');
        $decoded = null;
        try {
            $decoded = $token ? $jwtEncoder->decode($token) : null;
        } catch (\Exception $e) {
            $decoded = ['error' => $e->getMessage()];
        }

        dump($request->cookies->all(), $request->headers->all(), $this->getUser(), $decoded);

        $user = $this->getUser();
        if (!$user instanceof Users) {
            return new JsonResponse([
                'message' => 'Non authentifié',
                'debug' => [
                    'user' => $user,
                    'decoded' => $decoded,
                    'token' => $token
                ]
            ], 401);
        }

        return new JsonResponse([
            'message' => 'Tu es bien authentifié !',
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }



    
}
