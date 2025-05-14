<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class MessageController extends AbstractController
{
    #[Route('/api/message', name: 'message_list', methods: ['GET'])]   
    public function list(MessageRepository $messageRepository, SerializerInterface $serializer): Response
    {       
        $messages = $messageRepository->findAll();        
        $jsonContent = $serializer->serialize($messages, 'json', [
            'groups' => ['message:read'],
            'skip_null_values' => false,
        ]);
        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/contact', name :'request_contact' , methods:['POST'])]
    public function sendMessagecreate(Request $request, EntityManagerInterface $entityManager): Response
    {

        $data = json_decode($request->getContent(), true); 
        
        $message = new Message();
        $message
            ->setId(Uuid::v4())            
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setSubject($data['subject'])
            ->setContent($data['content']) 
            ->setIsRead(false)
            ->setIsResponded(false)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setProcessedBy(null);

        $entityManager->persist($message);
        $entityManager->flush();
        
        return new JsonResponse(['message' => 'Message envoyé avec succès'], 201);
    }


    #[Route('/contact', name: 'app_contact', methods: ['GET'])]
    public function contact(): Response
    {
        $response = $this->render('contact/contactPage.html.twig');
        $response->headers->set('X-Robots-Tag', 'noindex');
        return $response;
    }

}