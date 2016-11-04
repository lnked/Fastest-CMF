<?php

class templateRender extends Renderer
{
    protected $extension = '.twig';

	public function __construct($dir = '', $caching = null)
	{
		require_once PATH_CORE.DS.'lib'.DS.'templaters'.DS.'twig'.DS.'Autoloader.php';

		Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem(PATH_TPL.DS.$dir);

        $this->template = new Twig_Environment($loader, array(
			'template_dir'		=> 	PATH_TPL.DS.$dir,
			'cache'             =>	PATH_RUNTIME.DS.'cache',
	        'debug'             => 	false,
	        'autoescape'        => 	true,
	        'auto_reload'       => 	false,
	        'strict_variables'  => 	false,
	        'optimizations'     => 	-1,
	        'charset'           => 	$this->charset
		));

        $escaper = new Twig_Extension_Escaper('html');
        $this->template->addExtension($escaper);

        $optimizer = new Twig_Extension_Optimizer(Twig_NodeVisitor_Optimizer::OPTIMIZE_FOR);
        $this->template->addExtension($optimizer);

        // $this->template->addExtension(new Twig_Extensions_Extension_I18n());

        // Ruby erb syntax
		// $lexer = new Twig_Lexer($twig, array(
		//     'tag_comment'  => array('<%#', '%>'),
		//     'tag_block'    => array('<%', '%>'),
		//     'tag_variable' => array('<%=', '%>'),
		// ));

		// SGML Comment Syntax
		// $lexer = new Twig_Lexer($twig, array(
		//     'tag_comment'  => array('<!--#', '-->'),
		//     'tag_block'    => array('<!--', '-->'),
		//     'tag_variable' => array('${', '}'),
		// ));

		// Smarty like
		// $lexer = new Twig_Lexer($twig, array(
		//     'tag_comment'  => array('{*', '*}'),
		//     'tag_block'    => array('{', '}'),
		//     'tag_variable' => array('{$', '}'),
		// ));   

		$lexer = new Twig_Lexer($this->template, array(
			'tag_comment'   => array('{#', '#}'),
			'tag_block'     => array('{%', '%}'),
			'tag_variable'  => array('{{', '}}'),
			'interpolation' => array('#{', '}'),
		));

		$this->template->setLexer($lexer);
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
    	
    }

    public function display($template = '')
    {
  		$this->template->loadTemplate($template . $this->extension)->display($this->data);
    }
}