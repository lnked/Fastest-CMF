<?php

class templateRender extends Renderer
{
    protected $extension = '.tpl';

	public function __construct($dir = '')
	{
        $this->template = Fenom::factory(PATH_TEMPLATES.DS.$dir, PATH_RUNTIME);
        $this->template->setCompileDir(PATH_RUNTIME);
        $this->template->setOptions(Fenom::AUTO_STRIP);
        $this->template->setOptions(Fenom::FORCE_COMPILE);
   	}

	public function assign($key = '', $data = '', $cache = false)
    {
    	if (is_array($data))
		{
		    $this->data[$key] = $data;
		}
		else
		{
		    $this->data[$key] = htmlspecialchars($data, ENT_QUOTES, $this->charset);
		}
    }

    public function fetch($template = '', $cache_id = '', $compile_id = '')
    {
    	return $this->template->fetch($template, $this->data);
    }

    public function display($template = '')
    {
    	$this->template->display($template . $this->extension, $this->data);
    }
}