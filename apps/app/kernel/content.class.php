<?php declare(strict_types = 1);

class Content extends templateEngine
{
    use Singleton, Tools, Storage {
        Storage::__construct as private _storage;
    }

    public function __construct() {}

    protected function getContent()
    {
        $route = $this->router->dispatch(static::$request);
        
        if (isset($route[2]))
        {
            $response = $this->loadModule($route);

            if (!isset($response['module']))
            {
                return $response;
            }

            $module = $response['module'];
            $template = $response['template'];

            if ($this->is_admin)
            {
                $folder = 'backend';
            }
            else
            {
                $folder = 'frontend';
            }

            return $this->template->fetch(PATH_MODULES.DS.$module.DS.'views'.DS.$folder.DS.$template);
        }
        else
        {
            return $this->template->fetch(PATH_TEMPLATES.DS.'backend'.DS.'components'.DS.'demo');
        }
    }

    protected function loadModule($route = [])
    {
        if (DEV_MODE)
        {
            $this->clearStorage();
        }
     
        $data = $route[2];

        if (is_object($data))
        {
            if (isset($route[3]['vars']) && isset($route[3]['variables']))
            {
                $response = call_user_func_array($data, array_intersect_key($route[3]['vars'], array_flip($route[3]['variables'])));
            }
            else
            {
                $response = call_user_func($data);
            }
        }
        elseif (isset($data[0]) && isset($data[1]))
        {
            $controller = $data[0];
            $action = $data[1];

            $module = str_replace(['module', 'controller', 'model'], '', strtolower($controller));

            if (file_exists(PATH_MODULES.DS.$module.DS.'model'.DS.$module.'.model.php'))
            {
                require PATH_MODULES.DS.$module.DS.'model'.DS.$module.'.model.php';
            }
            
            if (file_exists(PATH_MODULES.DS.$module.DS.'controller'.DS.'backend'.DS.$module.'.module.php'))
            {
                require PATH_MODULES.DS.$module.DS.'controller'.DS.'backend'.DS.$module.'.module.php';
            }
            
            $response = Pux\RouteExecutor::execute($route);
            $response['module'] = $module;
        }

        return $response;
    }

    protected function loadController()
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
}