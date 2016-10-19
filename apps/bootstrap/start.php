<?php

# PATH
define('DS',                DIRECTORY_SEPARATOR);
define('BACKEND',           dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require BACKEND.DS.'bootstrap'.DS.'autoload.php';

/*
|--------------------------------------------------------------------------
| Application
|--------------------------------------------------------------------------
*/
$app = require_once BACKEND.DS.'bootstrap'.DS.'app.php';

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