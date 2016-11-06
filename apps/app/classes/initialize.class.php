<?php declare(strict_types = 1);

class Initialize extends templateEngine
{
    use Tools, Singleton;

    protected $request  = null;
    protected $locale   = null;
    
    protected $template = null;
    protected $template_dir = null;
    protected $template_driver = null;

    protected $is_admin   = false;
    protected $csrf_token = null;
    protected $csrf_param = 'authenticity_token';

    public $domain  = null;
    public $path    = [];
    public $page    = ['id' => 0];

    public function __construct()
    {
        $this->domain   =   $_SERVER['HTTP_HOST'];
        $this->request  =   urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->path     =   preg_split('/\/+/', $this->request, -1, PREG_SPLIT_NO_EMPTY);
        $this->locale   =   $this->getLocale($this->request, $this->path);

        $this->csrf();

        $this->checkAdmin();

        $this->initTemplate();
    }

    private function initTemplate()
    {
        if ($this->is_admin)
        {
            $this->template_dir = PATH_BACKEND;
            $this->template_driver = TEMPLATING_BACKEND;
        }
        else
        {
            $this->template_dir = PATH_FRONTEND;
            $this->template_driver = TEMPLATING_FRONTEND;
        }
        
        $this->template = new templateEngine($this->template_driver, $this->template_dir);

        if ($this->is_admin)
        {
            $this->template->assign('ADMIN_DIR', ADMIN_DIR);
        }
    }

    private function csrf()
    {
        if (defined('CSRF_PROTECTION') && CSRF_PROTECTION)
        {
            unset($_SESSION['csrf_param']);
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

                $_SESSION['csrf_param'] = $this->csrf_param;
                $_SESSION[$this->csrf_param] = base64_encode($token);
            }

            $this->csrf_token = $_SESSION[$this->csrf_param];
        }
    }

    private function checkAdmin()
    {
        $this->is_admin = isset($this->path[0]) && $this->path[0] == ADMIN_DIR;
    }
}