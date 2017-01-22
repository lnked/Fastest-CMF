<?php

date_default_timezone_set(FASTEST_TIMEZONE);

setlocale(LC_ALL, Tools::getLocale($_SERVER['REQUEST_URI']));

// installs global error and exception handlers
Rollbar::init(['access_token' => '6b18dcd7c7094d4eb601264ec922fda6'], false, false);

$environment = (new josegonzalez\Dotenv\Loader(PATH_CONFIG.DS.'.env'))->parse()->putenv(true);

QF('mysqli://'.getenv('DB_USER').':'.getenv('DB_PASS').'@'.getenv('DB_HOST').':'.getenv('DB_PORT').'/'.getenv('DB_BASE').'?encoding='.getenv('DB_CHAR'))
    ->connect()
    ->alias('default')
    ->tablePrefix(getenv('DB_PREF'));
