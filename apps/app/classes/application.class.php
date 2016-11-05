<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register() {

    }

    public function handle() {
        // __($this);

        $this->template->display('base');
    }

}