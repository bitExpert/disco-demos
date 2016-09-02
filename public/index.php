<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$config = new \bitExpert\Disco\BeanFactoryConfiguration($APP_CONF['di']['cache']);
$beanFactory = new \bitExpert\Disco\AnnotationBeanFactory($APP_CONF['di']['config'], $APP_CONF, $config);
\bitExpert\Disco\BeanFactoryRegistry::register($beanFactory);

$app = new Slim\App($beanFactory);

$app->get('/hello/{name}', function ($request, $response, $args) {
    $response->write('Hello, ' . $args['name']);
    return $response;
}
);

$app->run();
