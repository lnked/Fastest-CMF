<?php

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
define('APPS_ROOT', 'apps');

/**
 * Public root
 */
define('PUBLIC_ROOT', 'public_html');

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

// $app = new Silex\Application();

// $app->get('/hello/{name}', function($name) use($app) { 
//     return 'Hello '.$app->escape($name); 
// }); 

// $app->run();

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
$app->compile($_SERVER['REQUEST_URI']);