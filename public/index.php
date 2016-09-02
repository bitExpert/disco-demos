<?php

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
require 'config/config.php';

$config = new \bitExpert\Disco\BeanFactoryConfiguration($APP_CONF['di']['cache']);
/** @var \Interop\Container\ContainerInterface $container */
$beanFactory = new \bitExpert\Disco\AnnotationBeanFactory($APP_CONF['di']['config'], $APP_CONF, $config);
\bitExpert\Disco\BeanFactoryRegistry::register($beanFactory);

/** @var \Zend\Expressive\Application $app */
$app = $beanFactory->get(\Zend\Expressive\Application::class);
$app->run();
