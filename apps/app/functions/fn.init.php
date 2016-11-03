<?php

function fn_init_config($config = [])
{
    foreach ($config as $name => $value)
    {
        fn_define($name, $value);
    }
}