<?php

require __DIR__ . '/../vendor/autoload.php';

$beanFactory = new \bitExpert\Disco\AnnotationBeanFactory(\SlimDemo\Config::class);
\bitExpert\Disco\BeanFactoryRegistry::register($beanFactory);

$app = new Slim\App($beanFactory);

$app->get('/hello/{name}', function ($request, $response, $args) {
    $response->write('Hello, ' . $args['name']);
    return $response;
}
);

$app->run();
