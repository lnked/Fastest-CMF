<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */
    'NAME' => 'Fastest CMS',

    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    */
    'DEV_MODE' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Frontend templating
    |--------------------------------------------------------------------------
    |
    */
    'TEMPLATING_FRONTEND' => 'smarty',
    
    /*
    |--------------------------------------------------------------------------
    | Backend templating
    |--------------------------------------------------------------------------
    |
    */
    'TEMPLATING_BACKEND' => 'twig',
    
    /*
    |--------------------------------------------------------------------------
    | Force compile
    |--------------------------------------------------------------------------
    |
    */
    'FORCE_COMPILE' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    */
    'TEMPLATING_DEBUG' => false,
    
    /*
    |--------------------------------------------------------------------------
    | APP ROOT
    |--------------------------------------------------------------------------
    |
    */
    'APP_ROOT' => FASTEST_ROOT.APPS_ROOT.DS.'app',
    
    /*
    |--------------------------------------------------------------------------
    | Modules
    |--------------------------------------------------------------------------
    |
    */
    'PATH_MODULES' => FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'modules',

    /*
    |--------------------------------------------------------------------------
    | Templates directory
    |--------------------------------------------------------------------------
    |
    */
    'PATH_TEMPLATES' => FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'views',
    
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    */
    'PATH_TEMPLATING' => FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'templating',
    
    /*
    |--------------------------------------------------------------------------
    | Functions directory
    |--------------------------------------------------------------------------
    |
    */
    'PATH_FUNCTIONS' => FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'functions',

    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    */
    'PATH_RESOURCE' => FASTEST_ROOT.APPS_ROOT.DS.'app'.DS.'resource',
    
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    */
    'PATH_RUNTIME' => FASTEST_ROOT.APPS_ROOT.DS.'runtime',
    
    /*
    |--------------------------------------------------------------------------
    | CSRF Protection
    |--------------------------------------------------------------------------
    |
    */
    'CSRF_PROTECTION' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Public root
    |--------------------------------------------------------------------------
    |
    */
    'ADMIN_DIR' => 'cp',
    
    /*
    |--------------------------------------------------------------------------
    | Public root
    |--------------------------------------------------------------------------
    |
    */
    'PUBLIC_ROOT' => 'public_html',
    
    /*
    |--------------------------------------------------------------------------
    | PATH_BACKEND
    |--------------------------------------------------------------------------
    |
    */
    'PATH_BACKEND' => 'backend',
    
    /*
    |--------------------------------------------------------------------------
    | PATH_FRONTEND
    |--------------------------------------------------------------------------
    |
    */
    'PATH_FRONTEND' => 'frontend/#',

    /*
    |--------------------------------------------------------------------------
    | PATH_COMMON
    |--------------------------------------------------------------------------
    |
    */
    'PATH_COMMON' => 'common',

    /*
    |--------------------------------------------------------------------------
    | FRONTEND_THEME
    |--------------------------------------------------------------------------
    |
    */
    'FRONTEND_THEME' => 'default-theme',

    /*
    |--------------------------------------------------------------------------
    | CAPTCHA KEYSTRING
    |--------------------------------------------------------------------------
    |
    */
    'CAPTCHA_KEYSTRING' => 'captcha_keystring',

    /*
    |--------------------------------------------------------------------------
    | CAPTCHA URL
    |--------------------------------------------------------------------------
    |
    */
    'CAPTCHA_URL' => 'captcha',

    /*
    |--------------------------------------------------------------------------
    | Gzip compressed
    |--------------------------------------------------------------------------
    |
    */
    'GZIP_COMPRESS' => true,

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    'CACHING' => false,

    /*
    |--------------------------------------------------------------------------
    | Max upload file size, mb
    |--------------------------------------------------------------------------
    */
    'UPLOAD_MAX_FILESIZE' => 5,

    /*
    |--------------------------------------------------------------------------
    | Caching adapter
    |--------------------------------------------------------------------------
    */
    'CACHING_ADAPTER' => 'Memcached', // Redis | Couchbase | APC | MySQL | SQLite | PostgreSQL | Flysystem | Memory

    /*
    |--------------------------------------------------------------------------
    | Enabled caching
    |--------------------------------------------------------------------------
    */
    'ENABLED_CACHING' => true,

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    'DEBUG' => true,

    /*
    |--------------------------------------------------------------------------
    | Default timezone
    |--------------------------------------------------------------------------
    */
    'FASTEST_TIMEZONE' => 'Europe/Moscow',

    /*
    |--------------------------------------------------------------------------
    | TINYPNG API KEY
    |--------------------------------------------------------------------------
    */
    'TINYPNG_API_KEY' => 'fiZxjIh3dTZNwFPP7YTmW4rfZkCPUg0S',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */
    'LOCALE' => 'ru'
];