<?php

namespace App\Controller;

use App\Repository\EnclosureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class EnclosureController extends AbstractController
{
    #[Route('api/enclosures', name: 'enclosure_list', methods: ['GET'])]   
    public function list(EnclosureRepository $enclosureRepository, SerializerInterface $serializer): Response
    {       
        $enclosures = $enclosureRepository->findAll();        
        $jsonContent = $serializer->serialize($enclosures, 'json', [
            'groups' => ['enclosure:read'],
            'skip_null_values' => true,
        ]);
        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/enclosure', name: 'app_enclosure', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('enclosures/enclosuresPage.html.twig');
    }
}