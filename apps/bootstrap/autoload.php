<?php

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

# Autoload
#
spl_autoload_register(function($_class) {
    $_class = strtolower($_class);

    if ($_class == 'news' || $_class == 'newsitem')
    {
        // exit(PATH_MODULES.DS.'news'.DS.'models'.DS.$_class.'.Model.php');
    
    //     echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'models'.DS.$_class.'.Model.php', '<br><br>';
    //     echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php', '<br><br>';
    //     echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'frontend'.DS.$_class.'.Controller.php', '<br><br>';
    }

    if (file_exists(PATH_MODULES.DS.'news'.DS.'model'.DS.$_class.'.Model.php'))
    {
        require_once PATH_MODULES.DS.'news'.DS.'model'.DS.$_class.'.Model.php';
    }

    // if (file_exists(PATH_MODULES.DS.$_class.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php'))
    // {
    //     require_once PATH_MODULES.DS.$_class.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php';
    // }

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'kernel'.DS.$_class.'.trait.php'))
    {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'kernel'.DS.$_class.'.trait.php';
    }

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'kernel'.DS.$_class.'.class.php'))
    {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'kernel'.DS.$_class.'.class.php';
    }
    
    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php'))
    {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php';
    }

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php'))
    {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php';
    }
});