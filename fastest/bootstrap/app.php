<?php

$t1 = microtime(true);

// Make sure this is PHP 5.3 or later
// -----------------------------------------------------------------------------
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
{
    exit('Fastest-CMF requires PHP 5.3.0 or later, but you&rsquo;re running '.PHP_VERSION.'. Please talk to your host/IT department about upgrading PHP or your server.');
}

// Check for this early because Craft uses it before the requirements checker gets a chance to run.
if (!extension_loaded('mbstring') || (extension_loaded('mbstring') && ini_get('mbstring.func_overload') == 1))
{
    exit('Fastest-CMF requires the <a href="http://php.net/manual/en/book.mbstring.php" target="_blank">PHP multibyte string</a> extension in order to run. Please talk to your host/IT department about enabling it on your server.');
}

/**
 * define shorthand directory separator constant
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/**
 * Root directory
 */
defined('FASTEST_ROOT') || define('FASTEST_ROOT', dirname(getcwd()) . DS);

/**
 * Apps root
 */
defined('APPS_ROOT') || define('APPS_ROOT', 'fastest');

/*
|--------------------------------------------------------------------------
| Register Auto Loader
|--------------------------------------------------------------------------
*/
require FASTEST_ROOT.APPS_ROOT.DS.'bootstrap'.DS.'autoload.php';

/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
*/
require PATH_CONFIG.DS.'environment.php';

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
