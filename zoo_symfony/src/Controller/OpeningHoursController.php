<?php

namespace App\Controller;

use App\Repository\OpeningHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OpeningHoursController extends AbstractController
{
    #[Route('/opening-hours', name: 'get_opening_hours', methods: ['GET'])]
    public function getOpeningHours(OpeningHoursRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $hours = $repository->findAll();
        $data = $serializer->serialize($hours, 'json', ['groups' => ['opening_hours:read']]);

        return new JsonResponse($data, 200, [], true);
    }
}