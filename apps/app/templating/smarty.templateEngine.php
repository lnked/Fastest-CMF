<?php

class templateRender extends Renderer
{
	protected $extension = '.tpl';

	public function __construct($templateDir = '')
	{
		$this->template = new Smarty;

		$this->template->setCacheDir(PATH_RUNTIME);
		$this->template->setCompileDir(PATH_RUNTIME);
		$this->template->setTemplateDir($templateDir);
		
		$this->template->setCaching(CACHING);
		$this->template->setCacheLifetime(60);

		$this->template->use_sub_dirs           = true;
		$this->template->debugging              = TEMPLATING_DEBUG;
		$this->template->cache_modified_check   = false;
		$this->template->compile_check          = false;
		$this->template->force_compile          = FORCE_COMPILE;
		$this->template->error_reporting        = TEMPLATING_DEBUG ? E_ALL & ~E_NOTICE & ~E_WARNING : E_ALL & ~E_NOTICE;

		$this->template->addPluginsDir(APP_ROOT.DS.'functions'.DS.'smarty.plugins');
	}

	public function assign($key = '', $data = '', $cache = false)
	{
		$this->template->assign($key, $data, $cache);
	}

	public function fetch($template = '', $cache_id = '', $compile_id = '')
	{
		if (file_exists($template . $this->extension))
		{
			return $this->template->fetch($template . $this->extension);
		}
		else if (!strstr(strtolower($template), strtolower(FASTEST_ROOT)))
		{
			return $this->template->fetch($template);
		}
	}

	public function display($template = '')
	{
		$this->template->display($template . $this->extension);
	}
}