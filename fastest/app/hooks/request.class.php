<?php

$_OPTIONS = [];
$_HEAD = [];
$_DELETE = [];
$_TRACE = [];
$_CONNECT = [];

$_PUT = [];

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $putdata = file_get_contents('php://input');
    $exploded = explode('&', $putdata);

    foreach($exploded as $pair)
    {
        $item = explode('=', $pair);
 
        if (count($item) == 2)
        {
            $_PUT[urldecode($item[0])] = urldecode($item[1]);
        }
    }
}