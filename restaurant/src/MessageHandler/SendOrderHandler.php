<?php

namespace App\MessageHandler;

use App\Message\SendOrder;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendOrderHandler implements MessageHandlerInterface
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var OrderRepository */
    private $orderRepository;

    public function __construct(ProductRepository $productRepository, OrderRepository $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(SendOrder $message)
    {
        $data = json_decode($message->getContent(), true);

        $productsRef = $data['products'];

        // Todo must handle wrong input
        $products = $this->productRepository->findBy([
            'ref' => $productsRef
        ]);

        $this->orderRepository->saveOrder($products);
    }
}
