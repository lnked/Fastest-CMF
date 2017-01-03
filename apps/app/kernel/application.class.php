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

        $route = $this->router->dispatch(self::$request);

        if (isset($route[2]))
        {
            $result = Pux\RouteExecutor::execute($route);

            var_dump( $result );

            // exit(__($route[2] ));
            // exit(__($route[2], $route[2]['parameter'] ));
            // $data = call_user_func_array($route[2], $route[2]->parameter);
            // __($data);
        }

        $this->template->display($this->base_tpl);
    }
}