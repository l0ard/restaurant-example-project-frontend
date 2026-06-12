<?php

namespace App\Controller;

use App\Entity\Food;
use App\Entity\Origin;
use App\Entity\Tag;
use App\Repository\FoodRepository;
use App\Repository\OriginRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class FoodController extends AbstractController
{
    private FoodRepository $foodRepository;
    private TagRepository $tagRepository;
    private OriginRepository $originRepository;

    public function __construct(FoodRepository $foodRepository, TagRepository $tagRepository, OriginRepository $originRepository)
    {
        $this->foodRepository = $foodRepository;
        $this->tagRepository = $tagRepository;
        $this->originRepository = $originRepository;
    }

    #[Route('/api/foods', name: 'api_foods')]
    public function getAllFoods(): JsonResponse
    {
        return $this->json(
            $this->foodRepository->findAll(),
            context: ['groups' => ['food:read']]
        );
    }

    #[Route(
        '/api/foods/{id}',
        name: 'api_food',
        requirements: ['id' => '\d+'])]
    public function getFoodById(Food $food): JsonResponse
    {
        return $this->json(
            $food,
            context: ['groups' => ['food:read']]
        );
    }

    #[Route(
        '/api/foods/tag/{id}',
        requirements: ['id' => '\d+'],
        methods: ['GET'])]
    public function getAllFoodsByTag(Tag $tag): JsonResponse
    {
        return $this->json(
            $this->foodRepository->findByTag($tag),
            context: ['groups' => ['food:read']]
        );
    }

    #[Route(
        '/api/foods/origin/{id}',
        requirements: ['id' => '\d+'],
        methods: ['GET'],
    )]
    public function getAllFoodsByOrigin(Origin $origin): JsonResponse
    {
        return $this->json(
            $this->foodRepository->findByOrigin($origin),
            context: ['groups' => ['food:read']]
        );
    }

    #[Route(
        '/api/foods/search/{searchTerm}',
        methods: ['GET'],
    )]
    public function getAllFoodsBySearchTerm(string $searchTerm): JsonResponse
    {
        if(!$searchTerm)
            return new JsonResponse();

        return $this->json(
            $this->foodRepository->findBySearchTerm($searchTerm), 200, [], [
            'groups' => ['food:read']]
        );
    }

    #[Route('/api/foods/tags', name: 'api_foods_tags')]
    public function getAllTags(): JsonResponse
    {
        return $this->json(
            $this->tagRepository->findAll(),
            context: ['groups' => ['food:read']]
        );
    }

    #[Route('/api/foods/origins', name: 'api_foods_origins')]
    public function getAllOrigins(): JsonResponse
    {
        return $this->json(
            $this->originRepository->findAll(),
            context: ['groups' => ['food:read']]
        );
    }
}
