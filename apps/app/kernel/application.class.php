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

        $app = [
            'title'         => 'Fastest CMS',
            'controller'    => $this->controller,
            'action'        => $this->action,
            'params'        => $this->params,
            'content'       => $this->getContent()
        ];

        $this->template->assign('app', $app);
    }
    
    public function terminate()
    {
        $this->headers();

        $this->template->display($this->base_tpl);
    }
}