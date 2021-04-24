<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class RestaurantsController extends AbstractController
{
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(RestaurantRepository $restaurantRepository, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/api/restaurants", name="get_all_restaurants", methods={"GET"})
     * @return Response
     */
    public function getAll(): JsonResponse
    {
        $restaurants = $this->restaurantRepository->findAll();

        $data =
            $this->serializer->serialize(
                $restaurants,
                'json', ['groups' => ['list_restaurant']]
            );

        return JsonResponse::fromJsonString($data);
    }

    /**
     * @Route("/api/restaurants/{id}", name="get_one_restaurant", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $restaurant = $this->restaurantRepository->findOneBy(['id' => (int)$id]);

        if (!$restaurant) {
            return new JsonResponse(['status' => 'Restaurant not found !'], Response::HTTP_NOT_FOUND);
        }

        $data =
            $this->serializer->serialize(
                $restaurant,
                'json', ['groups' => ['show_restaurant']]
            );

        return JsonResponse::fromJsonString($data);
    }
}
