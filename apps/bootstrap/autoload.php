<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

require __DIR__.'/../vendor/autoload.php';

# Functions
#
$fn_list = [
    'fn.helpers.php',
    'fn.common.php',
    'fn.init.php'
];

foreach ($fn_list as $file) {
    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'functions'.DS.$file)) {
        require(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'functions'.DS.$file);
    }
}

# Config
#
fn_init_config(
    require(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'config'.DS.'app.php')
);

if (DEV_MODE)
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

    if (Whoops\Util\Misc::isAjaxRequest())
    {
        $whoops->pushHandler(new JsonResponseHandler);
    }

    $whoops->register();
}

# Autoload
#
spl_autoload_register(function($_class) {
    $_class = strtolower($_class);

    $paths = [
        'kernel',
        'hooks',
        'helpers',
        'classes',
        'services'
    ];

    #
    # Load class & trait

    foreach ($paths as $path)
    {
        if (file_exists(APP_ROOT.DS.$path.DS.$_class.'.class.php'))
        {
            require_once APP_ROOT.DS.$path.DS.$_class.'.class.php';
        }
        
        if (file_exists(APP_ROOT.DS.$path.DS.$_class.'.trait.php'))
        {
            require_once APP_ROOT.DS.$path.DS.$_class.'.trait.php';
        }
    }
});