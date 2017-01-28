<?php declare(strict_types = 1);

class templateEngine
{
    protected $template = null;

    public function __construct($driver = 'smarty', $dir = '', $theme = '')
    {
        $this->driver = strtolower($driver);

        if (!$theme)
        {
            $theme = FRONTEND_THEME;
        }

        if (strstr($dir, '#'))
        {
            $this->dir = str_replace('#', $theme, $dir);
        }

        $this->init();
    }

    protected function init()
    {
        if (file_exists(PATH_TEMPLATING.DS.$this->driver.'.templateEngine.php'))
        {
            if (!class_exists('templateRender'))
            {
                include_once PATH_TEMPLATING.DS.$this->driver.'.templateEngine.php';

                $this->template = new templateRender([
                    PATH_TEMPLATES.DS.$this->dir,
                    PATH_TEMPLATES.DS.PATH_COMMON
                ]);
            }
        }
    }

    protected function assign($key = '', $value = '', $cache = false)
    {
        $this->template->assign($key, $value, $cache);
    }

    protected function render()
    {
        return call_user_func_array(["templateEngine", "fetch"], func_get_args());
    }

    protected function fetch($template = '', $cache_id = '', $compile_id = '')
    {
        return $this->template->fetch($template);
    }

    protected function display($pattern = '')
    {
        $this->template->display($pattern);
    }
}