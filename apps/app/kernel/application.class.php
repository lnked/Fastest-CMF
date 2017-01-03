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

        $this->template->display($this->base_tpl);
    }
}