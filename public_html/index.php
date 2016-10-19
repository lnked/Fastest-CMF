<?php
/*
|--------------------------------------------------------------------------
| CELEBRO.CMS (http://cms.celebro.ru)
| @copyright Copyright (c) CELEBRO lab. (http://celebro.ru)
| @license http://cms.celebro.ru/license.txt
|--------------------------------------------------------------------------
*/

$t1 = microtime(true);

require_once __DIR__ . "/../apps/bootstrap/start.php";

$t2 = microtime(true);

echo  '<style>.cmsDebug-wrap{ position: fixed; left: 10px; bottom: 10px; z-index: 1000000; display: block; font-size: 0; } .cmsDebug { float: left; height: 18px; margin-right: 2px; font-size: 11px; line-height: 18px; font-style: normal; padding: 0 7px; color: #fff; } .cmsDebug span { padding: 0 5px; color: #ffffff; display: inline-block; } </style>'
    , '<span class="cmsDebug-wrap">'
    // , '<span class="cmsDebug" style="background: #d666af;">' . $_SESSION['sql'] . ' sql.</span>'
    , '<span class="cmsDebug" style="background: #cbc457;">' . count(get_included_files()) . ' Inc. files</span>'
    , '<span class="cmsDebug" style="background: #6379b7;">' . number_format(memory_get_peak_usage()/1048576, 3) . ' Mb.</span>'
    , '<span class="cmsDebug" style="background: #e5752b;">' . number_format(memory_get_usage()/1048576, 3) . ' Mb' . PHP_EOL . '</span>'
    , '<span class="cmsDebug" style="background: #6ab755;">' . number_format($t2-$t1, 3) . ' S.</span>'
    , '</span>';