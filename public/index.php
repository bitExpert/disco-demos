<?php

require __DIR__ . '/../vendor/autoload.php';

use bitExpert\Adroit\AdroitMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

$beanFactory = new \bitExpert\Disco\AnnotationBeanFactory(AdroitDemo\Config::class);
\bitExpert\Disco\BeanFactoryRegistry::register($beanFactory);

/** @var AdroitMiddleware $adroit */
$adroit = $beanFactory->get('adroit');
$request = ServerRequestFactory::fromGlobals()->withAttribute('action', 'helloAction');

$response = $adroit($request, new Response());
$emitter = new SapiEmitter();
$emitter->emit($response);
