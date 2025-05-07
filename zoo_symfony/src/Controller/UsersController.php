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
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UsersController extends AbstractController
{   
    #[Route('/users', name: 'user_list', methods: ['GET'])]
    public function list(UsersRepository $usersRepository, SerializerInterface $serializer): Response
    {        
        $users = $usersRepository->findAll();        
        $jsonContent = $serializer->serialize($users, 'json', [
            'groups' => ['user:read'],
            'skip_null_values' => true,
        ]);
        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/users', name: 'user_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager ,PasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($request->getContent(), true); 
        $user = new Users();
        $user
            ->setId(uniqid()) 
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setRole($data['role'])
            ->setCreatedAt(new \DateTime())
            ->setIsActive(true)
            ->setFirstLoginDone(false);
        
        $hashedPassword = $passwordHasher->hash("AzertyAzerty25");
        $user->setPassword($hashedPassword);
        $entityManager->persist($user);
        $entityManager->flush();
    
        return new Response('Création d\'un utilisateur');
    }

    #[Route('/users/{id}', name: 'user_update', methods: ['PUT'])]
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
            $user->setRole($data['role']);
        }

        $entityManager->flush();
        return new Response("Modification de l'utilisateur $id ");
    }

    #[Route('/users/{id}', name: 'user_delete', methods: ['DELETE'])]
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
