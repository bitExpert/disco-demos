<?php
declare(strict_types = 1);

namespace App\Project\Application\EventSubscribers;

use IceHawk\IceHawk\Events\HandlingReadRequestEvent;
use IceHawk\IceHawk\Events\ReadRequestWasHandledEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkReadEventSubscriber
 *
 * @package App\Project\Application\EventSubscribers
 */
final class IceHawkReadEventSubscriber extends AbstractEventSubscriber
{
    protected function getAcceptedEvents() : array
    {
        return [
            HandlingReadRequestEvent::class,
            ReadRequestWasHandledEvent::class,
        ];
    }

    public function whenHandlingReadRequest(HandlingReadRequestEvent $event)
    {
        # This method is called BEFORE the request handler handles the read request

        # You can access the request info via $event->getRequestInfo()
        # You can access the request input via $event->getRequestInput()
    }

    public function whenReadRequestWasHandled(ReadRequestWasHandledEvent $event)
    {
        # This method is called AFTER the request handler has handled the read request

        # You can access the request info via $event->getRequestInfo()
        # You can access the request input via $event->getRequestInput()
    }
}
