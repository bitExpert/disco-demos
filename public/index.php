<?php
declare(strict_types = 1);

namespace App\Project;

use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
use IceHawk\IceHawk\IceHawk;

require(__DIR__ . '/../vendor/autoload.php');

$beanFactory = new AnnotationBeanFactory(Config::class);
BeanFactoryRegistry::register($beanFactory);

/** @var Icehawk $application */
$application = $beanFactory->get('icehawk');
$application->init();
$application->handleRequest();
