<?php
declare(strict_types = 1);

namespace App;

use App\Action\HomePageAction;
use App\Action\HomePageFactory;
use App\Action\PingAction;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Annotations\Parameter;
use bitExpert\Disco\Annotations\Parameters;
use bitExpert\Disco\BeanFactoryRegistry;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Container\TemplatedErrorHandlerFactory;
use Zend\Expressive\Container\WhoopsErrorHandlerFactory;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\ServerUrlMiddlewareFactory;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Helper\UrlHelperFactory;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\TemplatedErrorHandler;
use Zend\Expressive\Twig\TwigRendererFactory;
use Zend\Expressive\WhoopsErrorHandler;

/**
 * @Configuration
 */
class Config
{
    /**
     * @Bean({"alias"="Zend\Expressive\Application"})
     */
    public function expressive() : Application
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $applicationFactory = new ApplicationFactory();

        return $applicationFactory($beanFactory);
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Router\RouterInterface"})
     */
    public function router() : \Zend\Expressive\Router\RouterInterface
    {
        return new FastRouteRouter();
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Helper\ServerUrlHelper"})
     */
    public function serverurlhelper() : ServerUrlHelper
    {
        return new ServerUrlHelper();
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Helper\UrlHelper"})
     */
    public function urlHelper() : UrlHelper
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new UrlHelperFactory();
        return $factory($beanFactory);
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Whoops"})
     */
    public function whoopsRun() : Run
    {
        return new Run();
    }

    /**
     * @Bean({"alias"="Zend\Expressive\WhoopsPageHandler"})
     */
    public function whoopsPageHandler() : PrettyPageHandler
    {
        return new PrettyPageHandler();
    }

    /**
     * @Bean({"alias"="Zend\Expressive\FinalHandler"})
     */
    public function whoopsFinalHandler() : WhoopsErrorHandler
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new WhoopsErrorHandlerFactory();
        return $factory($beanFactory);
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Helper\ServerUrlMiddleware"})
     */
    public function serverUrlHelperMiddleware() : ServerUrlMiddleware
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new ServerUrlMiddlewareFactory();
        return $factory($beanFactory);
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Helper\UrlHelperMiddleware"})
     */
    public function urlHelperMiddleware() : UrlHelperMiddleware
    {
        return new UrlHelperMiddleware($this->urlHelper());
    }

    /**
     * @Bean({"alias"="Zend\Expressive\FinalHandler"})
     */
    public function expressiveFinalHandler() : TemplatedErrorHandler
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new TemplatedErrorHandlerFactory();
        return $factory($beanFactory);
    }

    /**
     * @Bean({"alias"="Zend\Expressive\Template\TemplateRendererInterface"})
     */
    public function templateRenderer(): TemplateRendererInterface
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new TwigRendererFactory();
        return $factory($beanFactory);
    }

    /**
     * @Bean
     * @Parameters({
     *    @Parameter({"name" = "expressive"})
     * })
     */
    public function config(array $expressiveConfig = []) : array
    {
        $defaultConfig = [
            'debug' => true,

            'config_cache_enabled' => false,

            'zend-expressive' => [
                'error_handler' => [
                    'template_404'   => 'error::404',
                    'template_error' => 'error::error',
                ],
            ],
            // This can be used to seed pre- and/or post-routing middleware
            'middleware_pipeline' => [
                // An array of middleware to register. Each item is of the following
                // specification:
                //
                // [
                //  Required:
                //     'middleware' => 'Name or array of names of middleware services and/or callables',
                //  Optional:
                //     'path'     => '/path/to/match', // string; literal path prefix to match
                //                                     // middleware will not execute
                //                                     // if path does not match!
                //     'error'    => true, // boolean; true for error middleware
                //     'priority' => 1, // int; higher values == register early;
                //                      // lower/negative == register last;
                //                      // default is 1, if none is provided.
                // ],
                //
                // While the ApplicationFactory ignores the keys associated with
                // specifications, they can be used to allow merging related values
                // defined in multiple configuration files/locations. This file defines
                // some conventional keys for middleware to execute early, routing
                // middleware, and error middleware.
                'always' => [
                    'middleware' => [
                        // Add more middleware here that you want to execute on
                        // every request:
                        // - bootstrapping
                        // - pre-conditions
                        // - modifications to outgoing responses
                        ServerUrlMiddleware::class,
                    ],
                    'priority' => 10000,
                ],

                'routing' => [
                    'middleware' => [
                        ApplicationFactory::ROUTING_MIDDLEWARE,
                        UrlHelperMiddleware::class,
                        // Add more middleware here that needs to introspect the routing
                        // results; this might include:
                        // - route-based authentication
                        // - route-based validation
                        // - etc.
                        ApplicationFactory::DISPATCH_MIDDLEWARE,
                    ],
                    'priority' => 1,
                ],

                'error' => [
                    'middleware' => [
                        // Add error middleware here.
                    ],
                    'error'    => true,
                    'priority' => -10000,
                ],
            ],
            'routes' => [
                [
                    'name' => 'home',
                    'path' => '/',
                    'middleware' => HomePageAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'api.ping',
                    'path' => '/api/ping',
                    'middleware' => PingAction::class,
                    'allowed_methods' => ['GET'],
                ],
            ],
            'templates' => [
                'extension' => 'html.twig',
                'paths'     => [
                    'app'    => ['templates/app'],
                    'layout' => ['templates/layout'],
                    'error'  => ['templates/error'],
                ],
            ],
            'twig' => [
                'extensions'     => [
                    // extension service names or instances
                ],
            ]
        ];

        return array_merge($defaultConfig, $expressiveConfig);
    }

    /**
     * @Bean({"alias"="App\Action\PingAction"})
     */
    public function pingAction() : PingAction
    {
        return new PingAction();
    }

    /**
     * @Bean({"alias"="App\Action\HomePageAction"})
     */
    public function homeAction() : HomePageAction
    {
        $beanFactory = BeanFactoryRegistry::getInstance();
        $factory = new HomePageFactory();
        return $factory($beanFactory);
    }
}
