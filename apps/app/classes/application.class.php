<?php declare(strict_types = 1);

final class Application // extends Initialize
{

    public function __construct() {}

    public function compile($path = '')
    {
        $argv = [];

        if ($argv) {
            $argv = parse_str(implode('&', array_slice($argv, 1)), $_GET);
        }

        // echo '<pre>';
        // exit(print_r($_SERVER));

        echo $path;
    }

}