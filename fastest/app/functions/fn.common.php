<?php

function fn_define($const, $value)
{
    if (!defined($const)) {
        define($const, $value);
    }
}