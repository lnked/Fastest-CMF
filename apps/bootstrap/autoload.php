<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/config/functions.php';

spl_autoload_register(function($_class) {
    $_class = strtolower($_class);

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php')) {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php';
    }
});