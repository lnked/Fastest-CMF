<?php

final class CSRF
{
    protected $csrf_token = null;
    protected $csrf_param = 'authenticity_token';

    public function __construct()
    {
        if (defined('CSRF_PROTECTION') && CSRF_PROTECTION)
        {
            $this->generate();
            $this->store();
        }
    }

    public function get()
    {
        if (isset($_SESSION[$this->csrf_param]))
        {
            return $_SESSION[$this->csrf_param];
        }

        return false;
    }

    public function validate($data = [])
    {
        if (isset($data[$this->csrf_param]))
        {
            if (!is_string($data[$this->csrf_param]))
            {
                return false;
            }

            return hash_equals($data[$this->csrf_param], $_SESSION[$this->csrf_param]);
        }

        return false;
    }
 
    private function generate()
    {
        if (function_exists('random_bytes'))
        {
            $token = random_bytes(64);
        }
        elseif (function_exists('mcrypt_create_iv'))
        {
            $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        }
        else
        {
            $token = bin2hex(openssl_random_pseudo_bytes(32));
        }

        $this->csrf_token = base64_encode($token);
    }

    private function store()
    {
        if (!count($_POST))
        {
            $this->clean();
            
            if (empty($_SESSION[$this->csrf_param]))
            {
                $_SESSION['csrf_param'] = $this->csrf_param;
                $_SESSION[$this->csrf_param] = $this->csrf_token;
            }
        }
    }

    private function clean()
    {
        unset($_SESSION['csrf_param']);
        unset($_SESSION[$this->csrf_param]);
    }
}

// function csrfguard_replace_forms($form_data_html)
// {
//     $count=preg_match_all("/<form(.*?)>(.*?)<\\/form>/is",$form_data_html,$matches,PREG_SET_ORDER);
//     if (is_array($matches))
//     {
//         foreach ($matches as $m)
//         {
//             if (strpos($m[1],"nocsrf")!==false) { continue; }
//             $name="CSRFGuard_".mt_rand(0,mt_getrandmax());
//             $token=csrfguard_generate_token($name);
//             $form_data_html=str_replace($m[0],
//                 "<form{$m[1]}>
// <input type='hidden' name='CSRFName' value='{$name}' />
// <input type='hidden' name='CSRFToken' value='{$token}' />{$m[2]}</form>",$form_data_html);
//         }
//     }
//     return $form_data_html;
// }

// function csrfguard_inject()
// {
//     $data=ob_get_clean();
//     $data=csrfguard_replace_forms($data);
//     echo $data;
// }
// function csrfguard_start()
// {
//     if (count($_POST))
//     {
//         if ( !isset($_POST['CSRFName']) or !isset($_POST['CSRFToken']) )
//         {
//             trigger_error("No CSRFName found, probable invalid request.",E_USER_ERROR);     
//         } 
//         $name =$_POST['CSRFName'];
//         $token=$_POST['CSRFToken'];
//         if (!csrfguard_validate_token($name, $token))
//         { 
//             throw new Exception("Invalid CSRF token.");
//         }
//     }
//     ob_start();
//     /* adding double quotes for "csrfguard_inject" to prevent: 
//           Notice: Use of undefined constant csrfguard_inject - assumed 'csrfguard_inject' */
//     register_shutdown_function("csrfguard_inject"); 
// }