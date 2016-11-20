<?php
declare(strict_types = 1);

namespace App\Project\Application\EventSubscribers;

use IceHawk\IceHawk\Events\HandlingWriteRequestEvent;
use IceHawk\IceHawk\Events\WriteRequestWasHandledEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkWriteEventSubscriber
 *
 * @package App\Project\Application\EventSubscribers
 */
final class IceHawkWriteEventSubscriber extends AbstractEventSubscriber
{
    protected function getAcceptedEvents() : array
    {
        return [
            HandlingWriteRequestEvent::class,
            WriteRequestWasHandledEvent::class,
        ];
    }

    public function whenHandlingWriteRequest(HandlingWriteRequestEvent $event)
    {
        # This method is called BEFORE the request handler handles the write request

        # You can access the request info via $event->getRequestInfo()
        # You can access the request input via $event->getRequestInput()
    }

    public function whenWriteRequestWasHandled(WriteRequestWasHandledEvent $event)
    {
        # This method is called AFTER the request handler has handled the write request

        # You can access the request info via $event->getRequestInfo()
        # You can access the request input via $event->getRequestInput()
    }
}
