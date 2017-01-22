<?php

$t1 = microtime(true);

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

$_SESSION['sql'] = 0;

/*
|--------------------------------------------------------------------------
| Register Auto Loader
|--------------------------------------------------------------------------
*/
require FASTEST_ROOT.APPS_ROOT.DS.'bootstrap'.DS.'autoload.php';

setlocale(LC_ALL, Tools::getLocale($_SERVER['REQUEST_URI']));

date_default_timezone_set(FASTEST_TIMEZONE);

// installs global error and exception handlers
Rollbar::init(['access_token' => '6b18dcd7c7094d4eb601264ec922fda6']);

$environment = (new josegonzalez\Dotenv\Loader(PATH_CONFIG.DS.'.env'))->parse()->putenv(true);

QF('mysqli://'.getenv('DB_USER').':'.getenv('DB_PASS').'@'.getenv('DB_HOST').':'.getenv('DB_PORT').'/'.getenv('DB_BASE').'?encoding='.getenv(DB_CHAR))
    ->connect()
    ->alias('default')
    ->tablePrefix(getenv('DB_PREF'));

/*
|--------------------------------------------------------------------------
| Application
|--------------------------------------------------------------------------
*/
$app = new Application();

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/
$app->router = require PATH_CONFIG.DS.'routes.php';

/*
|--------------------------------------------------------------------------
| Run Application
|--------------------------------------------------------------------------
*/
$app->launch();

/*
|--------------------------------------------------------------------------
| Terminate Application
|--------------------------------------------------------------------------
*/
$app->terminate();

session_write_close();

$t2 = microtime(true);

echo '<style>.cmsDebug-wrap{ position: fixed; left: 50%; -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); -o-transform: translateX(-50%); transform:  translateX(-50%); bottom: 4px; z-index: 1000000; display: block; font-size: 0; } .cmsDebug { float: right; height: 18px; margin-left: 2px; font-size: 11px; line-height: 18px; font-style: normal; padding: 0 7px; color: #fff; } .cmsDebug span { padding: 0 5px; color: #ffffff; display: inline-block; } </style>'
    , '<span class="cmsDebug-wrap">'
    , '<span class="cmsDebug" style="background: #d666af;">' . $_SESSION['sql'] . ' sql.</span>'
    , '<span class="cmsDebug" style="background: #cbc457;">' . count(get_included_files()) . ' Inc. files</span>'
    , '<span class="cmsDebug" style="background: #6379b7;">' . number_format(memory_get_peak_usage()/1048576, 3) . ' Mb.</span>'
    , '<span class="cmsDebug" style="background: #e5752b;">' . number_format(memory_get_usage()/1048576, 3) . ' Mb' . PHP_EOL . '</span>'
    , '<span class="cmsDebug" style="background: #6ab755;">' . number_format($t2-$t1, 3) . ' S.</span>'
    , '</span>';
