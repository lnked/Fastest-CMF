<?php

class templateRender extends Renderer
{
    // protected $extension = '.html';

	public function __construct($dir = '')
	{
		$this->template_dir = $dir;
	}

	public function assign($key = '', $data = '', $caching = false)
    {
    	if (is_array($data) || is_object($data))
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
		    $file = PATH_TEMPLATES . '/' . $this->template_dir . $template . $this->extension;

		    if (file_exists($file))
		    {
		    	ob_start();

			    if (extension_loaded('zlib'))
	            {
	                ob_implicit_flush(0);
	                header('Content-Encoding: gzip');
	            }

	            extract($this->data);

				require_once $file;
				
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