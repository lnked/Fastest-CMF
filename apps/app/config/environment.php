<?php

date_default_timezone_set(FASTEST_TIMEZONE);

setlocale(LC_ALL, Tools::getLocale($_SERVER['REQUEST_URI']));

Rollbar::init(['access_token' => getenv('ROLLBAR_TOKEN')], false, false);

$environment = (new josegonzalez\Dotenv\Loader(PATH_CONFIG.DS.'.env'))->parse()->putenv(true);

QF('mysqli://'.getenv('DB_USER').':'.getenv('DB_PASS').'@'.getenv('DB_HOST').':'.getenv('DB_PORT').'/'.getenv('DB_BASE').'?encoding='.getenv('DB_CHAR'))
    ->connect()
    ->alias('default')
    ->tablePrefix(getenv('DB_PREF'));
