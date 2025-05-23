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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

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

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): Response
    {
        $cookie = Cookie::create('BEARER')->withValue('')->withExpires(time() - 3600);
        $response = new Response(json_encode(['message' => 'Déconnecté avec succès']));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->setCookie($cookie);

        return $response;
    }

    #[Route('/login', name: 'app_login')]
    public function contact(Request $request, ValidatorInterface $validator)
    {
        $errors = [];

        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            $constraints = new Assert\Collection([
                'email' => [new Assert\NotBlank(), new Assert\Email()],                
                'password' => [new Assert\NotBlank(), new Assert\Length(['min' => 12])],
            ]);

            $violations = $validator->validate($data, $constraints);

            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            if (empty($errors)) {
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('login/loginPage.html.twig', [
            'errors' => $errors,
            'email' => $request->request->get('email'),
            'name' => $request->request->get('password'),
        ]);
    }




    
}
