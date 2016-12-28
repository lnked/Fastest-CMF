<?php

if (!function_exists('__')) {
    function __()
    {
        $args = func_get_args();
        $nargs = func_num_args();
        $trace = debug_backtrace();
        $caller = array_shift($trace);

        $key = $caller['file'].':'.$caller['line'];

        echo '<pre>', $key, "\n";
        for ($i=0; $i<$nargs; $i++)
            echo print_r($args[$i], 1), "\n";
        
        echo '</pre>';
    }
}

function fn_redirect($url = '', $referer = '')
{
    if ($url !== '')
    {  
        header("Location: $url", true, 301);
    }    
    else
    {
        if ($referer !== '')
        {
            header("Location: $referer", true, 301);
        }
        else {
            if ($_SERVER['QUERY_STRING'] !== '') header("Location: ". $_SERVER['SCRIPT_NAME'] . "?" . $_SERVER['QUERY_STRING']);
            else header("Location: " . $_SERVER['SCRIPT_NAME']);
        }
    }

    exit;
}

function fn_rrmdir($dir = '', $internal_only = false, $is_inner = false)
{
    if (is_dir($dir))
    {
        $files = array_diff(scandir($dir), array('.', '..', '.gitkeep', '.gitignore'));

        foreach ($files as $file)
        {
            if (is_dir($dir.DS.$file))
            {
                fn_rrmdir($dir.DS.$file, $internal_only, true);
            }
            else
            {
                unlink($dir.DS.$file);
            }
        }

        reset($files);

        if (!$internal_only || $is_inner)
        {
            rmdir($dir);
        }
    }
}