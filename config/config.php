<?php

$APP_CONF = [];

// Disco configuration
$APP_CONF['di'] = [];
$APP_CONF['di']['config'] = \App\Config::class;
$APP_CONF['di']['cache'] = sys_get_temp_dir();

// Expressive configuration
$APP_CONF['expressive']['debug'] = true;
$APP_CONF['expressive']['config_cache_enabled'] = false;

// Whoops configuration
$APP_CONF['expressive']['whoops']['json_exceptions']['display'] = true;
$APP_CONF['expressive']['whoops']['json_exceptions']['show_trace'] = true;
$APP_CONF['expressive']['whoops']['json_exceptions']['ajax_only'] = true;

// Twig configuration
$APP_CONF['expressive']['twig']['cache_dir'] = 'data/cache/twig';
$APP_CONF['expressive']['twig']['assets_url'] = '/';
$APP_CONF['expressive']['twig']['assets_version'] = null;
