<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    public function launch()
    {
        if (count($_POST))
        {
            if ($this->csrf->validate($_POST))
            {
                exit(__("<b style='color: green'>valid</b>", $_POST));
            }
            else
            {
                exit(__("<b style='color: red'>invalid</b>", $_POST));
            }
        }

        $this->initHooks();

        // use Nette\Http;

        // https://doc.nette.org/en/2.4/
        // https://github.com/nette/http

        // $input = $request->only(['username', 'password']);

        // $input = $request->only('username', 'password');

        // $input = $request->except(['credit_card']);

        // $input = $request->except('credit_card');
        // Determining If An Input Value Is Present

        // if ($request->has('name')) {
        //     //
        // }

        // Without Query String...
        // $url = $request->url();

        // With Query String...
        // $url = $request->fullUrl();

        // $uri = $request->path();
        // if ($request->is('admin/*')) {
        // $url = $request->url();
        // $method = $request->method();
        // if ($request->isMethod('post')) {
        //     //
        // }

        $this->app->title = 'Fastest CMS';
        $this->app->controller = $this->controller;
        $this->app->action = $this->action;
        $this->app->params = $this->params;
        $this->app->content = $this->getContent();
    }
    
    public function terminate()
    {
        $this->headers();

        $this->addMetaTag('generator', 'Fastest CMF');
        $this->addMetaTag('yandex-verification', '50ce195670bd0ab0');

        # Debugger
        $this->initDebugger(true);

        $this->responseCode(200);

        $this->template->assign('app', $this->app);
        $this->template->display($this->base_tpl);
    }
}