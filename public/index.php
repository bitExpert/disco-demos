<?php
declare(strict_types = 1);

namespace App\Project;

use IceHawk\IceHawk\IceHawk;

require(__DIR__ . '/../vendor/autoload.php');

$config      = new IceHawkConfig();
$delegate    = new IceHawkDelegate();
$application = new IceHawk( $config, $delegate );

$application->init();
$application->handleRequest();
