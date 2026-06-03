<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class FoodController extends AbstractController
{
    #[Route('/api/foods', name: 'api_foods')]
    public function getAllFoods(FoodRepository $foodRepository): JsonResponse
    {
        return $this->json(
            $foodRepository->findAll(),
            context: ['groups' => ['food:read']]
        );
    }
}
