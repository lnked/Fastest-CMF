<?php

class templateRender extends Renderer
{
	protected $extension = '.tpl';

	public function __construct($dir = '', $caching = null)
	{
		$this->template = new Smarty;

		$this->template->setCacheDir(PATH_RUNTIME);
		$this->template->setCompileDir(PATH_RUNTIME);
		$this->template->setTemplateDir(PATH_TEMPLATES.DS.$dir);
		
		$this->template->setCaching($caching);
		$this->template->setCacheLifetime(60);

		$this->template->use_sub_dirs           = true;
		$this->template->debugging              = false;
		$this->template->cache_modified_check   = false;
		$this->template->compile_check          = false;
		$this->template->force_compile          = false;
		$this->template->error_reporting        = (defined('SYSTEM_DEBUG') && SYSTEM_DEBUG == 1) ? E_ALL & ~E_NOTICE & ~E_WARNING : E_ALL & ~E_NOTICE;

		$pluginsDir = [
			FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'functions'.DS.'smarty_plugins',
			// PATH_CORE.DS.'lib'.DS.'templaters'.DS.'smarty'.DS.'plugins'.DS,
			// PATH_CORE.DS.'lib'.DS.'templaters'.DS.'smarty'.DS.'plugins_cms'.DS
		];

		foreach ($pluginsDir as $d)
		{
			if (is_dir($d))
			{
				$this->template->addPluginsDir($d);
			}
		}
	}

	public function assign($key = '', $value = '', $caching = false)
	{
		$this->template->assign($key, $value, $caching);
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