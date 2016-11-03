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

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php')) {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php';
    }

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php')) {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php';
    }
});