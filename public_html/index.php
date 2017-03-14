<?php
/*
|--------------------------------------------------------------------------
| CELEBRO.CMS (https://cms.celebro.ru)
|
| @copyright Copyright (c) CELEBRO lab. (https://celebro.ru)
|
| @license https://cms.celebro.ru/license.txt
|--------------------------------------------------------------------------
*/
$bootstrap = '../fastest/bootstrap/app.php';

if (!is_file($bootstrap))
{
    if (function_exists('http_response_code'))
    {
        http_response_code(503);
    } else {
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Retry-After: 3600');
    }

    exit('Could not find your fastest/ folder. Please ensure that <strong><code>$bootstrap</code></strong> is set correctly in '.__FILE__);
}

require_once $bootstrap;
