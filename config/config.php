<?php

$APP_CONF = [];

// Disco configuration
$APP_CONF['di'] = [];
$APP_CONF['di']['config'] = \SlimDemo\Config::class;
$APP_CONF['di']['cache'] = sys_get_temp_dir();

// Slim configuration
$APP_CONF['slim']['httpVersion'] = '1.1';
$APP_CONF['slim']['responseChunkSize'] = 4096;
$APP_CONF['slim']['outputBuffering'] = 'append';
$APP_CONF['slim']['determineRouteBeforeAppMiddleware'] = false;
$APP_CONF['slim']['displayErrorDetails'] = false;
$APP_CONF['slim']['addContentLengthHeader'] = true;
$APP_CONF['slim']['routerCacheFile'] = false;
