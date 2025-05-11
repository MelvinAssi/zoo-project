<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{   
    #[Route('/api/admin/users', name: 'user_list', methods: ['GET'])]   
    public function list(UsersRepository $usersRepository, SerializerInterface $serializer): Response
    {       
        $users = $usersRepository->findAll();        
        $jsonContent = $serializer->serialize($users, 'json', [
            'groups' => ['user:read'],
            'skip_null_values' => true,
        ]);
        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/api/admin/users', name: 'user_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Décoder le contenu JSON de la requête
        $data = json_decode($request->getContent(), true); 
        
        // Créer une nouvelle instance de l'utilisateur
        $user = new Users();
        $user
            ->setId(uniqid())  // Générer un ID unique
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setRoles($data['role'])
            ->setCreatedAt(new \DateTime())  // Date de création de l'utilisateur
            ->setIsActive(true)  // L'utilisateur est actif
            ->setFirstLoginDone(false);  // Le premier login n'est pas fait
    
        // Hacher le mot de passe
        $hash = password_hash($data['password'], PASSWORD_ARGON2ID);
        $user->setPassword($hash);

        // Persister et sauvegarder l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();
        
        // Retourner une réponse indiquant la création de l'utilisateur
        return new Response('Création d\'un utilisateur');
    }
    

    #[Route('/api/admin/users/{id}', name: 'user_update', methods: ['PUT'])]
    public function update(Request $request,EntityManagerInterface $entityManager,UsersRepository $usersRepository,string $id): Response
    {
        $data = json_decode($request->getContent(), true); 
        $user = $usersRepository->find($id);
    
        if (!$user) {
            return new Response("Utilisateur non trouvé", 404);
        }
        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }
    
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
    
        if (isset($data['role'])) {
            $user->setRoles($data['role']);
        }

        $entityManager->flush();
        return new Response("Modification de l'utilisateur $id ");
    }

    #[Route('/api/admin/users/{id}', name: 'user_delete', methods: ['DELETE'])]
    public function delete(string $id, UsersRepository $usersRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $usersRepository->find($id);
    
        if (!$user) {
            return new Response("Utilisateur non trouvé", 404);
        }
    
        $entityManager->remove($user);
        $entityManager->flush();
    
        return new Response("Utilisateur $id supprimé avec succès");
    }

    

}
