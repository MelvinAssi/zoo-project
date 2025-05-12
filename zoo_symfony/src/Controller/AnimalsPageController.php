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

    #[Route('/animal/random/{count}', name: 'animal_random', methods: ['GET'])]
    public function random(AnimalRepository $animalRepository, int $count = 4): JsonResponse
    {
        $allAnimals = $animalRepository->findAll();
        shuffle($allAnimals);
        $randomAnimals = array_slice($allAnimals, 0, $count);

        return $this->json($randomAnimals, 200, [], ['groups' => ['animal:read']]);
    }


    #[Route('/animals', name: 'app_animals', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('animals/animalsPage.html.twig');
    }
}