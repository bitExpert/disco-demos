<?php
declare(strict_types = 1);

namespace App\Project\Application\EventSubscribers;

use IceHawk\IceHawk\Events\IceHawkWasInitializedEvent;
use IceHawk\IceHawk\Events\InitializingIceHawkEvent;
use IceHawk\IceHawk\PubSub\AbstractEventSubscriber;

/**
 * Class IceHawkInitEventSubscriber
 *
 * @package App\Project\Application\EventSubscribers
 */
final class IceHawkInitEventSubscriber extends AbstractEventSubscriber
{
    protected function getAcceptedEvents() : array
    {
        return [
            InitializingIceHawkEvent::class,
            IceHawkWasInitializedEvent::class,
        ];
    }

    protected function whenInitializingIceHawk(InitializingIceHawkEvent $event)
    {
        # This method is called AFTER setUpGlobalVars and getRequestInfo
        # and BEFORE setUpErrorHandling and setUpSessionHandling

        # You can access the request info via $event->getRequestInfo()
    }

    protected function whenIceHawkWasInitialized(IceHawkWasInitializedEvent $event)
    {
        # This method is called AFTER setUpErrorHandling and setUpSessionHandling

        # You can access the request info via $event->getRequestInfo()
    }
}
