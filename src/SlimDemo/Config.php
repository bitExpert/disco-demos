<?php
declare(strict_types = 1);

namespace SlimDemo;

use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Annotations\Parameter;
use bitExpert\Disco\Annotations\Parameters;
use bitExpert\Disco\BeanFactoryRegistry;
use Slim\CallableResolver;
use Slim\Handlers\Error;
use Slim\Handlers\NotAllowed;
use Slim\Handlers\NotFound;
use Slim\Handlers\PhpError;
use Slim\Handlers\Strategies\RequestResponse;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;

/**
 * @Configuration
 */
class Config
{
    /**
     * @Bean
     * @Parameters(
     *     @Parameter({"name" = "slim"})
     * )
     */
    public function settings(array $slimConfig = []) : array
    {
        return $slimConfig;
    }

    /**
     * @Bean
     */
    public function environment() : Environment
    {
        return new Environment($_SERVER);
    }

    /**
     * @Bean
     */
    public function request() : Request
    {
        $beanFactory = BeanFactoryRegistry::getInstance();

        return Request::createFromEnvironment($beanFactory->get('environment'));
    }

    /**
     * @Bean
     */
    public function response() : Response
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $headers = new Headers(['Content-Type' => 'text/html; charset=UTF-8']);
        $response = new Response(200, $headers);

        return $response->withProtocolVersion($beanFactory->get('settings')['httpVersion']);
    }

    /**
     * @Bean
     */
    public function router() : Router
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $routerCacheFile = false;
        if (isset($beanFactory->get('settings')['routerCacheFile'])) {
            $routerCacheFile = $beanFactory->get('settings')['routerCacheFile'];
        }

        return (new Router)->setCacheFile($routerCacheFile);
    }

    /**
     * @Bean
     */
    public function foundHandler() :RequestResponse
    {
        return new RequestResponse;
    }

    /**
     * @Bean
     */
    public function phpErrorHandler() : PhpError
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        return new PhpError($beanFactory->get('settings')['displayErrorDetails']);
    }

    /**
     * @Bean
     */
    public function errorHandler() : Error
    {
        $beanFactory = BeanFactoryRegistry::getInstance();

        return new Error($beanFactory->get('settings')['displayErrorDetails']);
    }

    /**
     * @Bean
     */
    public function notFoundHandler() : NotFound
    {
        return new NotFound();
    }

    /**
     * @Bean
     */
    public function notAllowedHandler() : NotAllowed
    {
        return new NotAllowed();
    }

    /**
     * @Bean
     */
    public function callableResolver() : CallableResolver
    {
        return new CallableResolver(BeanFactoryRegistry::getInstance());
    }
}
