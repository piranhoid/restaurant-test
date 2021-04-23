<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantsController extends AbstractController
{
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/api/restaurants", name="get_all_restaurants", methods={"GET"})
     * @return Response
     */
    public function getAll(): Response
    {
        $restaurants = $this->restaurantRepository->findAll();

        return new Response($restaurants);
    }
}
