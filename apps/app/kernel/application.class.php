<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    private function initialize()
    {
    }

    public function launch()
    {
        if (count($_POST))
        {
            exit(__($_POST, $_SESSION[$this->csrf_param]));
        }

        $this->initMVC();
        
        $this->initHooks();

        $app = [
            'title'         => 'Fastest CMS',
            'controller'    => $this->controller,
            'action'        => $this->action,
            'params'        => $this->params,
            'content'       => $this->getContent()
        ];

        $this->initialize();

        $this->template->assign('app', $app);
    }
    
    public function terminate()
    {
        $this->headers();

        $this->template->display($this->base_tpl);
    }
}