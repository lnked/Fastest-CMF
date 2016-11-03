<?php

session_start();

/**
 * define shorthand directory separator constant
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * Root directory
 */
if (!defined('FASTEST_ROOT')) {
    define('FASTEST_ROOT', dirname(getcwd()) . DS);
}

/**
 * Apps root
 */
if (!defined('APPS_ROOT')) {
    define('APPS_ROOT', 'apps');
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require FASTEST_ROOT.APPS_ROOT.DS.'bootstrap'.DS.'autoload.php';

/*
|--------------------------------------------------------------------------
| Application
|--------------------------------------------------------------------------
*/
$app = require_once FASTEST_ROOT.APPS_ROOT.DS.'bootstrap'.DS.'app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
$app->handle();