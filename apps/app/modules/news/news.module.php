<?php

function news()
{
    $items = [];

    $items['urokone'] = [
        'page callback' => 'drupal_get_form',
        'page arguments' => [
            'urokone_formone'
        ]
    ];

    return $items;
}