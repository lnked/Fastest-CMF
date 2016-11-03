<?php declare(strict_types = 1);

class Initialize // extends Viewer
{
    use Tools, Singleton;

    protected $request  = null;
    protected $locale   = null;
    
    // protected $viewer = null;
    // protected $template_dir = null;
    // protected $template_driver = null;

    protected $csrf_token = null;
    protected $csrf_param = 'authenticity_token';

    public $query   = null;
    public $path    = array();
    public $domain  = null;
    public $page    = array('id' => 0);

    // public $server  = 'localhost';
    // public $canonical    = array('id' => 0);

    public function __construct()
    {
        $this->domain   =   $_SERVER['HTTP_HOST'];
        $this->query    =   $_SERVER['QUERY_STRING'];
        $this->request  =   urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->path     =   preg_split('/\/+/', $this->request, -1, PREG_SPLIT_NO_EMPTY);
        $this->locale   =   $this->getLocale($this->request);

        if (isset($this->path[0]) && $this->path[0] == $this->locale)
        {
            array_shift($this->path);
        }

        # CSRF
        #
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

        // $this->template_driver = strtolower($this->template_driver);

        // if (strstr($this->template_dir, '#'))
        // {
        //     $this->template_dir = str_replace('#', $this->template_driver, $this->template_dir);
        // }

        // $this->viewer = new Viewer($this->template_driver, $this->template_dir, 0);
    }

    public function register()
    {

    }
}