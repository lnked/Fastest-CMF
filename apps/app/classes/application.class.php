<?php declare(strict_types = 1);

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    private function initialize()
    {
        if ($this->controller == 'cache')
        {
            fn_rrmdir(PATH_RUNTIME, true);
            fn_redirect('/'.ADMIN_DIR);
        }

        if (!empty($this->action))
        {
            $_class = $this->action;
            
            // if ($_class == 'news')
            // {
            //     echo $_class, ': ', PATH_MODULES.DS.'models'.DS.$_class.'.Model.php', '<br><br>';
            //     echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php', '<br><br>';
            //     echo $_class, ': ', PATH_MODULES.DS.'controller'.DS.'frontend'.DS.$_class.'.Controller.php', '<br><br>';
            // }

            // if (file_exists(PATH_MODULES.DS.$_class.DS.'controller'.DS.'models'.DS.$_class.'.Model.php'))
            // {
            //     require_once PATH_MODULES.DS.$_class.DS.'controller'.DS.'models'.DS.$_class.'.Model.php';
            // }
            
            if (file_exists(PATH_MODULES.DS.$_class.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php'))
            {
                require_once PATH_MODULES.DS.$_class.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php';
            }

            // exit(PATH_MODULES.DS.$_class.DS.'controller'.DS.'backend'.DS.$_class.'.Controller.php');

            if (class_exists($_class))
            {
                $module = new $_class;
                // exit(__('load: ', $controller, $module));
            }

            // exit(__('controller: ', $this->controller, 'action: ', $this->action, 'params: ', $this->params));

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


    private function loadController()
    {
        $this->controller = $this->module . 'Controller';
        
        if (!class_exists($this->controller))
        {
            $this->errorPage();
        }
        else
        {
            $controller = new $this->controller;
            
            if (method_exists($controller, $this->action))
            {
                $data = $controller->{$this->action}($this->transfer);

                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
                {
                    exit(json_encode($data, 64 | 256));
                }

                if ($this->module == 'ajax')
                {
                    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
                    {
                        exit($data);
                    }

                    return true;
                }

                $tpl_exbody = '';

                if (!empty($data) && is_array($data))
                {
                    foreach($data as $key => $value)
                    {
                        $this->viewer->assign($key, $value, false); 
                    }

                    if (isset($data['tpl_exbody']))
                    {
                        $tpl_exbody = $data['tpl_exbody'];
                    }
                }

                $this->info_array = array();

                if (isset($this->localize[$this->action . '_name']))
                {
                    $this->info_array['name']   = $this->localize[$this->action . '_name'];
                }
                else if (isset($this->localize[$this->module . '_name']))
                {
                    $this->info_array['name']   = $this->localize[$this->module . '_name'];
                }

                if (isset($this->localize[$this->action . '_header']))
                {
                    $this->info_array['header'] = $this->localize[$this->action . '_header'];
                }
                else if (isset($this->localize[$this->module . '_header']))
                {
                    $this->info_array['header'] = $this->localize[$this->module . '_header'];
                }

                foreach($this->info_array as $k=>$v)
                {
                    $this->viewer->assign($k, $v);
                }

                $tpl_exbody = $this->moduleTemplate($tpl_exbody);
                
                if (!file_exists($tpl_exbody . '.twig' ))
                {
                    $this->errorPage();
                }
                else
                {
                    $this->viewer->assign('content', $this->viewer->fetch($tpl_exbody), true);
                }
            }
        }
    }

    protected function getContent()
    {
        return $this->template->fetch(PATH_MODULES.DS.'news'.DS.'views'.DS.'backend/index');
    }

    public function handle()
    {
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