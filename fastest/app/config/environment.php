<?php

session_start();

// PHP environment normalization
// -----------------------------------------------------------------------------

// These have been deprecated in PHP 5.6 in favor of default_charset, which defaults to 'UTF-8'
// http://php.net/manual/en/migration56.deprecated.php
if (PHP_VERSION_ID < 50600)
{
    mb_internal_encoding('UTF-8');
    mb_http_input('UTF-8');
    mb_http_output('UTF-8');
}

mb_detect_order('auto');

// Normalize how PHP's string methods (strtoupper, etc) behave.
setlocale(LC_CTYPE,
    'C.UTF-8',     // libc >= 2.13
    'C.utf8',      // different spelling
    'en_US.UTF-8', // fallback to lowest common denominator
    'en_US.utf8'   // different spelling for fallback
);
// setlocale(LC_CTYPE, Tools::getLocale($_SERVER['REQUEST_URI']));
// setlocale(LC_ALL, Tools::getLocale($_SERVER['REQUEST_URI']));

// Set default timezone
date_default_timezone_set(FASTEST_TIMEZONE);

$_SESSION['sql'] = 0;

$environment = (new josegonzalez\Dotenv\Loader(PATH_CONFIG.DS.'.env'))->parse()->putenv(true);

Rollbar::init(['access_token' => getenv('ROLLBAR_TOKEN')], false, false);

QF('mysqli://'.getenv('DB_USER').':'.getenv('DB_PASS').'@'.getenv('DB_HOST').':'.getenv('DB_PORT').'/'.getenv('DB_BASE').'?encoding='.getenv('DB_CHAR'))
    ->connect()
    ->alias('default')
    ->tablePrefix(getenv('DB_PREF'));

// $detect = new Mobile_Detect;

// // Basic detection.
// $detect->isMobile();
// $detect->isTablet();

// exit(__($detect));

// // // Magic methods.
// $detect->isIphone();
// $detect->isSamsung();

// // Alternative to magic methods.
// $detect->is('iphone');

// // Find the version of component.
// $detect->version('Android');

// // Additional match method.
// $detect->match('regex.*here');

// // Browser grade method.
// $detect->mobileGrade();

// // Batch methods.
// $detect->setUserAgent($userAgent);
// $detect->setHttpHeaders($httpHeaders);


// // Check for mobile environment.
// if ($detect->isMobile()) {
//     // Your code here.
// }

// // Check for tablet device.
// if($detect->isTablet()){
//     // Your code here.
// }

// // Check for any mobile device, excluding tablets.
// if ($detect->isMobile() && !$detect->isTablet()) {
//     // Your code here.
// }

// //  Keep the value in $_SESSION for later use
// //    and for optimizing the speed of the code.
// if(!$_SESSION['isMobile']){
//     $_SESSION['isMobile'] = $detect->isMobile();
// }

// // Redirect the user to your mobile version of the site.
// if($detect->isMobile()){
//     header('http://m.yoursite.com', true, 301);
// }


// // Include and instantiate the class.
// require_once 'Mobile_Detect.php';
// $detect = new Mobile_Detect;

// // Any mobile device (phones or tablets).
// if ( $detect->isMobile() ) {

// }

// // Any tablet device.
// if( $detect->isTablet() ){

// }

// // Exclude tablets.
// if( $detect->isMobile() && !$detect->isTablet() ){

// }

// // Check for a specific platform with the help of the magic methods:
// if( $detect->isiOS() ){

// }

// if( $detect->isAndroidOS() ){

// }

// // Alternative method is() for checking specific properties.
// // WARNING: this method is in BETA, some keyword properties will change in the future.
// $detect->is('Chrome')
// $detect->is('iOS')
// $detect->is('UCBrowser')
// $detect->is('Opera')

// // Batch mode using setUserAgent():
// $userAgents = array(
// 'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
// 'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',

// );
// foreach($userAgents as $userAgent){

//   $detect->setUserAgent($userAgent);
//   $isMobile = $detect->isMobile();
//   $isTablet = $detect->isTablet();
//   // Use the force however you want.

// }

// // Get the version() of components.
// // WARNING: this method is in BETA, some keyword properties will change in the future.
// $detect->version('iPad'); // 4.3 (float)
// $detect->version('iPhone') // 3.1 (float)
// $detect->version('Android'); // 2.1 (float)
// $detect->version('Opera Mini'); // 5.0 (float)
