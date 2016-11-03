<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/functions/fn.helpers.php';

// $fn_list = array(
//     'fn.database.php',
//     'fn.users.php',
//     'fn.catalog.php',
//     'fn.cms.php',
//     'fn.cart.php',
//     'fn.locations.php',
//     'fn.common.php',
//     'fn.fs.php',
//     'fn.images.php',
//     'fn.init.php',
//     'fn.control.php',
//     'fn.search.php',
//     'fn.promotions.php',
//     'fn.log.php',
//     'fn.companies.php',
//     'fn.addons.php'
// );

// $fn_list[] = 'fn.' . strtolower(PRODUCT_EDITION) . '.php';

// foreach ($fn_list as $file) {
//     require($config['dir']['functions'] . $file);
// }

spl_autoload_register(function($_class) {
    $_class = strtolower($_class);

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php')) {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.trait.php';
    }

    if (file_exists(FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php')) {
        require_once FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'classes'.DS.$_class.'.class.php';
    }
});