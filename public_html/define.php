<?php

error_reporting(E_ALL | E_STRICT);

define('LOCAL_SERVER', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')));
define('DEV_MODE', LOCAL_SERVER);

ini_set('display_errors', DEV_MODE);
ini_set('display_startup_errors', DEV_MODE);
ini_set('error_reporting', 32767);

ini_set('session.gc_maxlifetime', 2678400);
ini_set('session.cookie_lifetime', 2678400);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid', 0);

if (!defined(__DIR__))
{
	$_ROOT = $_SERVER['DOCUMENT_ROOT'];
}
else {
	$_ROOT = __DIR__;
}

if (substr($_ROOT, -1) == '/') $_ROOT = substr($_ROOT, 0, -1);

define('ADMIN_DIR', 		'cp');
define('TEMPLATING',        'Smarty'); // PHP | Smarty | Fenom | Twig
define('GZIP_COMPRESS',     true);
define('CSRF_PROTECTION',   true);
define('DEFAULT_LANGUAGE',  'ru');

# PATH
define('PATH_ROOT',			$_ROOT);
define('PATH_PROTECTED', 	DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'protected');
define('PATH_SECURE', 		dirname(PATH_ROOT).DIRECTORY_SEPARATOR.'protected');
define('ADMIN_PATH', 		PATH_ROOT.DIRECTORY_SEPARATOR.ADMIN_DIR);
define('PATH_CORE',         PATH_SECURE.DIRECTORY_SEPARATOR.'core');
define('PATH_MODULE', 		PATH_SECURE.DIRECTORY_SEPARATOR.'modules');
define('PATH_RUNTIME', 		PATH_SECURE.DIRECTORY_SEPARATOR.'runtime');
define('PATH_TPL', 			PATH_SECURE.DIRECTORY_SEPARATOR.'templates');
define('PATH_PUBLIC', 		PATH_ROOT.DIRECTORY_SEPARATOR.'apps');
define('PATH_EXTENSIONS', 	PATH_CORE.DIRECTORY_SEPARATOR.'extensions');

# API
define('TRANSLATE_API', 'trnsl.1.1.20150906T141528Z.634470d03ea1e762.2bad0e1f563db5cf22a91b87182866b13d349941');

require_once PATH_CORE.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.inc.php';

// exit( t('add.something', ['string'=> 'ed']) );

//🙈🙉🙊