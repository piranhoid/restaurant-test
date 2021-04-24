<?php

namespace App\MessageHandler;

use App\Message\SendOrder;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendOrderHandler implements MessageHandlerInterface
{
    public function __invoke(SendOrder $message)
    {
        // do something with your message
    }
}
