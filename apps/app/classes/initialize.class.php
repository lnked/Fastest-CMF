<?php declare(strict_types = 1);

class Initialize extends templateEngine
{
    use Tools, Singleton;

    protected $request  = null;
    protected $locale   = null;
    
    protected $template = null;
    protected $template_dir = null;
    protected $template_driver = null;

    protected $csrf_token = null;
    protected $csrf_param = 'authenticity_token';

    public $domain  = null;
    public $path    = array();
    public $page    = array('id' => 0);

    public function __construct()
    {
        $this->domain   =   $_SERVER['HTTP_HOST'];
        $this->request  =   urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->path     =   preg_split('/\/+/', $this->request, -1, PREG_SPLIT_NO_EMPTY);
        $this->locale   =   $this->getLocale($this->request, $this->path);
        
        $this->template_driver = strtolower($this->template_driver);

        if (strstr($this->template_dir, '#'))
        {
            $this->template_dir = str_replace('#', $this->template_driver, $this->template_dir);
        }

        $this->template = new templateEngine($this->template_driver, $this->template_dir, false);
    }

    public function csrfProtection()
    {
        if (defined('CSRF_PROTECTION') && CSRF_PROTECTION)
        {
            unset($_SESSION[$this->csrf_param]);
            
            if (empty($_SESSION[$this->csrf_param]))
            {
                if (function_exists('mcrypt_create_iv'))
                {
                    $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
                }
                else
                {
                    $token = bin2hex(openssl_random_pseudo_bytes(32));
                }

                $_SESSION[$this->csrf_param] = base64_encode($token);
            }

            $this->csrf_token = $_SESSION[$this->csrf_param];
        }
    }

    public function register()
    {

    }
}