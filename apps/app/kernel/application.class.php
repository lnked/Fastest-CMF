<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    private function initialize()
    {
        if ($this->is_admin && $this->controller == 'cache')
        {
            fn_rrmdir(PATH_RUNTIME, true);
            fn_redirect('/'.ADMIN_DIR);
        }
    }

    public function handle()
    {
        if (count($_POST))
        {
            exit(__($_POST, $_SESSION[$this->csrf_param]));
        }

        $this->initMVC();

        $app = [
            'title'         => 'Fastest CMS',
            'controller'    => $this->controller,
            'action'        => $this->action,
            'params'        => $this->params,
            'content'       => $this->getContent()
        ];

        $this->initialize();

        $this->template->assign('app', $app);

        $this->template->display('base');
    }

}