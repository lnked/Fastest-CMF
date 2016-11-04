<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        $this->template_driver = TEMPLATING;
        $this->template_dir = 'apps/app/views/frontend/#/';
        parent::__construct();
    }

    public function register() {

    }

    public function handle() {
        __($this);
    }

}