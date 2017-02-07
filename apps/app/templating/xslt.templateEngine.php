<?php

/*
<?xml version="1.0"?>
<?xml-stylesheet type="text/xsl" href="applyt.xsl" ?>
<customers>
   <customer>
      <name>John Smith</name>
      <address>123 Oak St.</address>
      <state>WA</state>
      <phone>(206) 123-4567</phone>
   </customer>
   <customer>
      <name>Zack Zwyker</name>
      <address>368 Elm St.</address>
      <state>WA</state>
      <phone>(206) 423-4537</phone>
   </customer>
   <customer>
      <name>Albert Aikens</name>
      <address>368 Elm St.</address>
      <state>WA</state>
      <phone>(206) 423-4537</phone>
   </customer>
   <customer>
      <name>Albert Gandy</name>
      <address>6984 4th St.</address>
      <state>WA</state>
      <phone>(206) 433-4547</phone>
   </customer>
   <customer>
      <name>Peter Furst</name>
      <address>456 Pine Av.</address>
      <state>CA</state>
      <phone>(209) 765-4321</phone>
   </customer>
   <customer>
      <name>Dan Russell</name>
      <address>9876 Main St.</address>
      <state>PA</state>
      <phone>(323) 321-7654</phone>
   </customer>
</customers>
*/

class templateRender extends Renderer
{
    // protected $extension = '.xsl';

	public function __construct($dir = '')
	{
		$this->template_dir = $dir;
	}

	public function assign($key = '', $data = '', $caching = false)
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