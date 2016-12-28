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

    // if ($_class == 'news' || $  == 'newsitem')
    // {
    //     // exit(PATH_MODULES.DS.'news'.DS.'models'.DS.$_class.'.Model.php');
    //     // echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'models'.DS.$_class.'.Model.php', '<br><br>';
    //     // echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php', '<br><br>';
    //     // echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'frontend'.DS.$_class.'.Controller.php', '<br><br>';
    // }

    #
    # Load module
    // if (file_exists(PATH_MODULES.DS.'news'.DS.'model'.DS.$_class.'.Model.php'))
    // {
    //     require_once PATH_MODULES.DS.'news'.DS.'model'.DS.$_class.'.Model.php';
    // }

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