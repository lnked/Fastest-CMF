<?php

require __DIR__.'/../vendor/autoload.php';

spl_autoload_register(function($_class) {
    $_class = strtolower($_class);

    if (file_exists(BACKEND.DS.'app'.DS.'classes'.DS.$_class.'.class.php'))
    {
        require_once BACKEND.DS.'app'.DS.'classes'.DS.$_class.'.class.php';
    }
});