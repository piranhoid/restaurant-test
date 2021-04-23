<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /** @var OrderRepository */
    private $orderRepository;

    /** @var ProductRepository */
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/api/orders/", name="add_order", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $productsId = $data['products'];

        // Todo must handle wrong input
        $products = $this->productRepository->findBy([
            'id' => $productsId
        ]);

        $this->orderRepository->saveOrder($products);

        return new Response(['status' => 'Order created!'], Response::HTTP_CREATED);
    }
}
