<?php declare(strict_types = 1);

final class Application // extends Initialize
{

    public function __construct() {}

    public function register() {

    }

    public function handle($uri = '') {
        __($uri, $_SERVER);
    }

}