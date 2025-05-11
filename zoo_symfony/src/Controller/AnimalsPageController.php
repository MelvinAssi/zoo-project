<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnimalsPageController extends AbstractController
{
    #[Route('/animal', name: 'animal_list', methods: ['GET'])]   
    public function list(AnimalRepository $animalRepository, SerializerInterface $serializer): Response
    {       
        $animals = $animalRepository->findAll();        
        $jsonContent = $serializer->serialize($animals, 'json', [
            'groups' => ['animal:read'],
            'skip_null_values' => true,
        ]);
        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/animals', name: 'app_animals', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('animals/animalsPage.html.twig');
    }
}