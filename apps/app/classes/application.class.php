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
        $this->initMVC();

        $app = [
            'title'         => 'Fastest CMS',
            'controller'    => $this->controller,
            'action'        => $this->action,
            'params'        => $this->params
        ];
        
        $this->template->assign('app', $app);

        $this->template->display('base');
    }

}