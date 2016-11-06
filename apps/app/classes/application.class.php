<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {

    }

    public function handle()
    {
        $app = [
            'title' => 'Fastest CMS'
        ];
    
        // __($this);

        $this->template->assign('app', $app);
        $this->template->display('base');
    }

}