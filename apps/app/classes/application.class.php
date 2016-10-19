<?php

final class Application {

    public function __construct() {

    }

    public function compile($path = '')
    {
        // if ($argv) {
        //     parse_str(implode('&', array_slice($argv, 1)), $_GET);
        // }

        echo $path;
    }

}

// composer create-project --prefer-dist laravel/lumen app