<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\SendOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/api/orders", name="add_order", methods={"POST"})
     */
    public function add(Request $request, MessageBusInterface $bus): JsonResponse
    {
        $bus->dispatch(new SendOrder($request->getContent()));

        return new JsonResponse(['status' => 'Order dispatched !'], Response::HTTP_CREATED);
    }
}
