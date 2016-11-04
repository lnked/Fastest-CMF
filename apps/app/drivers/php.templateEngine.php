<?php

class templateRender extends Renderer
{
    protected $extension = '.php';

	public function __construct($dir = '', $caching = null)
	{
		$this->template_dir = $dir;
	}

	public function assign($key = '', $value = '', $caching = false)
    {
    	if (is_array($value))
		{
		    $this->data[$key] = $value;
		}
		else
		{
		    $this->data[$key] = htmlspecialchars($value, ENT_QUOTES, $this->charset);
		}
    }

    public function fetch($template = '', $cache_id = '', $compile_id = '')
    {
    	if (file_exists($template . $this->extension))
    	{
    		return include($template . $this->extension);
    	}

    	return '';
    }

    /**
     * Safely escape/encode the provided data.
     */
    public function e($v = '')
    {
    	return htmlspecialchars((string) $v, ENT_QUOTES, $this->charset);
    }

    public function display($template = '')
	{
		try {
		    $file = PATH_TPL . '/' . $this->template_dir . $template . $this->extension;

		    if (file_exists($file))
		    {
		    	ob_start();

			    if (extension_loaded('zlib'))
	            {
	                ob_implicit_flush(0);
	                header('Content-Encoding: gzip');
	            }

	            extract($this->data);

				include_once($file);
				
				$output = ob_get_contents();
				
				ob_end_clean();
				
				if ($this->strip)
				{
					$output = preg_replace("#[\n\t]#", '', $output);
				}

				echo $output;
		    }
		    else
		    {
		        throw new Exception('Template ' . $template . ' not found!');
		    }

		}
		catch (Exception $e)
		{
		    echo $e->getMessage();
		}
    }
}