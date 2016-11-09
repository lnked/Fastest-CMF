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

    private function initialize()
    {
        if ($this->controller == 'cache')
        {
            fn_rrmdir(PATH_RUNTIME, true);
            fn_redirect('/'.ADMIN_DIR);
        }

        if (!empty($this->controller))
        {
            exit(__('controller: ', $this->controller, 'action: ', $this->action, 'params: ', $this->params));

            // http://fastest.dev/cp/site/news/edit/10

            // site
            // news
            // Array
            // (
            //     [0] => edit
            //     [1] => 10
            // )

        }
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

        $this->initialize();

        $this->template->assign('app', $app);

        $this->template->display('base');
    }

}