<?php
declare(strict_types = 1);

namespace App\Project;

use App\Project\Application\Endpoints\Start\Read\SayHelloRequestHandler;
use App\Project\Application\Endpoints\Start\Write\DoSomethingRequestHandler;
use App\Project\Application\EventSubscribers\IceHawkInitEventSubscriber;
use App\Project\Application\EventSubscribers\IceHawkReadEventSubscriber;
use App\Project\Application\EventSubscribers\IceHawkWriteEventSubscriber;
use App\Project\Application\FinalResponders\FinalReadResponder;
use App\Project\Application\FinalResponders\FinalWriteResponder;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\BeanFactoryRegistry;
use IceHawk\IceHawk\Defaults\RequestInfo;
use IceHawk\IceHawk\IceHawk;
use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToReadRequest;
use IceHawk\IceHawk\Interfaces\RespondsFinallyToWriteRequest;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\ReadRoute;
use IceHawk\IceHawk\Routing\WriteRoute;

/**
 * @Configuration
 */
class Config
{
    /**
     * @Bean
     */
    public function requestInfo() : ProvidesRequestInfo
    {
        return RequestInfo::fromEnv();
    }

    /**
     * @Bean
     */
    public function readRoutes() : array
    {
        # Define your read routes (GET / HEAD) here
        # For matching the URI you can use the Literal, RegExp or NamedRegExp pattern classes

        return [
            new ReadRoute(new Literal('/'), new SayHelloRequestHandler()),
        ];
    }

    /**
     * @Bean
     */
    public function writeRoutes() : array
    {
        # Define your write routes (POST / PUT / PATCH / DELETE) here
        # For matching the URI you can use the Literal, RegExp or NamedRegExp pattern classes

        return [
            new WriteRoute(new Literal('/do-something'), new DoSomethingRequestHandler()),
        ];
    }

    /**
     * @Bean
     */
    public function eventSubscribers() : array
    {
        # Register your subscribers for IceHawk events here

        return [
            new IceHawkInitEventSubscriber(),
            new IceHawkReadEventSubscriber(),
            new IceHawkWriteEventSubscriber(),
        ];
    }

    /**
     * @Bean
     */
    public function finalReadResponder() : RespondsFinallyToReadRequest
    {
        # Provide a final responder for read requests here

        return new FinalReadResponder();
    }

    /**
     * @Bean
     */
    public function finalWriteResponder() : RespondsFinallyToWriteRequest
    {
        # Provide a final responder for write requests here

        return new FinalWriteResponder();
    }

    /**
     * @Bean
     */
    public function icehawk() : IceHawk
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $config = new IceHawkDiscoConfigDelegate($beanFactory);
        $delegate = new IceHawkDelegate();
        return new IceHawk($config, $delegate);
    }
}
