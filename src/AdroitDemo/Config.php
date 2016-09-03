<?php
declare(strict_types = 1);

namespace AdroitDemo;

use bitExpert\Adroit\Action\Resolver\ContainerActionResolver;
use bitExpert\Adroit\AdroitMiddleware;
use bitExpert\Adroit\Responder\Resolver\ContainerResponderResolver;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\BeanFactoryRegistry;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @Configuration
 */
class Config
{
    /**
     * @Bean
     */
    public function adroit() : AdroitMiddleware
    {
        return new AdroitMiddleware('action', [$this->actionResolver()], [$this->responderResolver()]);
    }

    /**
     * @Bean
     */
    public function actionResolver() : ContainerActionResolver
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        return new ContainerActionResolver($beanFactory);
    }

    /**
     * @Bean
     */
    public function responderResolver() : ContainerResponderResolver
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        return new ContainerResponderResolver($beanFactory);
    }

    /**
     * @Bean
     */
    public function helloAction() : Callable
    {
        return function (ServerRequestInterface $request, ResponseInterface $response) {
            $response->getBody()->rewind();
            $response->getBody()->write('Hello Adroit!');
            return $response;
        };
    }
}
