<?php

class templateRender extends Renderer
{
    protected $extension = '.twig';

	public function __construct($dir = '')
	{
		$loader = new Twig_Loader_Filesystem(PATH_TEMPLATES.DS.$dir);
        
        $loader->addPath(FASTEST_ROOT.PUBLIC_ROOT.DS.ADMIN_DIR.DS.'frontend'.DS);

        $this->template = new Twig_Environment($loader, [
        	'template_dir'		=> 	PATH_TEMPLATES.DS.$dir,
        	'cache'             =>	PATH_RUNTIME,
            'debug'             => 	TEMPLATING_DEBUG,
            'auto_reload'       =>  FORCE_COMPILE,
            'autoescape'        => 	true,
            'strict_variables'  => 	false,
            'optimizations'     => 	true,
            'charset'           => 	$this->charset
        ]);

        $this->template->addExtension(new Twig_Extension_Escaper('html'));
        $this->template->addExtension(new Twig_Extension_Optimizer(Twig_NodeVisitor_Optimizer::OPTIMIZE_FOR));
        
        $lexer = new Twig_Lexer($this->template, [
        	'tag_comment'   => ['{#', '#}'],
        	'tag_block'     => ['{%', '%}'],
        	'tag_variable'  => ['{{', '}}'],
        	'interpolation' => ['#{', '}'],
        ]);

        $this->template->setLexer($lexer);
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
    {}

    public function display($template = '')
    {
        // exit($template . $this->extension);
        $this->template->addGlobal("session", $_SESSION);
  		$this->template->loadTemplate($template . $this->extension)->display($this->data);
    }
}