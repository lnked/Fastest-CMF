<?php
/*
|--------------------------------------------------------------------------
| CELEBRO.CMS (http://cms.celebro.ru)
|
| @copyright Copyright (c) CELEBRO lab. (http://celebro.ru)
|
| @license http://cms.celebro.ru/license.txt
|--------------------------------------------------------------------------
*/
$t1 = microtime(true);

require_once __DIR__ . "/../apps/bootstrap/start.php";

$t2 = microtime(true);

echo  '<style>.cmsDebug-wrap{ position: fixed; right: 10px; bottom: 10px; z-index: 1000000; display: block; font-size: 0; } .cmsDebug { float: right; height: 18px; margin-left: 2px; font-size: 11px; line-height: 18px; font-style: normal; padding: 0 7px; color: #fff; } .cmsDebug span { padding: 0 5px; color: #ffffff; display: inline-block; } </style>'
    , '<span class="cmsDebug-wrap">'
    // , '<span class="cmsDebug" style="background: #d666af;">' . $_SESSION['sql'] . ' sql.</span>'
    , '<span class="cmsDebug" style="background: #cbc457;">' . count(get_included_files()) . ' Inc. files</span>'
    , '<span class="cmsDebug" style="background: #6379b7;">' . number_format(memory_get_peak_usage()/1048576, 3) . ' Mb.</span>'
    , '<span class="cmsDebug" style="background: #e5752b;">' . number_format(memory_get_usage()/1048576, 3) . ' Mb' . PHP_EOL . '</span>'
    , '<span class="cmsDebug" style="background: #6ab755;">' . number_format($t2-$t1, 3) . ' S.</span>'
    , '</span>';



/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
// define('DRUPAL_ROOT', getcwd());

// require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
// drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
// menu_execute_active_handler();





// *
//  * @file
//  * The PHP page that serves all page requests on a Drupal installation.
//  *
//  * The routines here dispatch control to the appropriate handler, which then
//  * prints the appropriate page.
//  *
//  * All Drupal code is released under the GNU General Public License.
//  * See COPYRIGHT.txt and LICENSE.txt.
 

// require 'vendor/autoload.php';
// use Pux\Mux;
// use Pux\Executor;
// $mux = new Mux;
// $mux->get('/get', ['HelloController','helloAction']);
// $mux->post('/post', ['HelloController','helloAction']);
// $mux->put('/put', ['HelloController','helloAction']);

// $mux->mount('/hello', new HelloController);

// $route = $mux->dispatch( $_SERVER['PATH_INFO'] );
// echo Executor::execute($route);

// $pageMux = new Mux;
// $pageMux->add('/', [ 'PageController', 'page1' ]);
// $pageMux->add('/pa', [ 'PageController', 'page1' ]);
// $pageMux->add('/page', [ 'PageController', 'page1' ]);
// $pageMux->sort();

// require 'vendor/autoload.php';
// $mux = require 'mux.php';
// $route = $mux->dispatch( $_SERVER['PATH_INFO'] );
// echo Executor::execute($route);

// require 'vendor/autoload.php';
// use Pux\Mux;
// $mux = new Mux;
// $mux->get('/get', ['HelloController','helloAction']);
// return $mux;

// $mainMux = new Mux;
// $mainMux->expand = true;

// $pageMux = new Mux;
// $pageMux->add('/page1', [ 'PageController', 'page1' ]);
// $pageMux->add('/page2', [ 'PageController', 'page2' ]);

// // short-hand syntax
// $pageMux->add('/page2', 'PageController:page2'  );

// $mainMux->mount('/sub', $pageMux);

// foreach( ['/sub/page1', '/sub/page2'] as $p ) {
//     $r = $mainMux->dispatch($p);
//     ok($r, "Matched route for $p");
// }

// require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
// drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
// // drupal_flush_all_caches();
// menu_execute_active_handler();

// require 'vendor/autoload.php'; // use PCRE patterns you need Pux\PatternCompiler class.
// use Pux\Executor;

// class ProductController {
//     public function listAction() {
//         return 'product list';
//     }
//     public function itemAction($id) { 
//         return "product $id";
//     }
// }
// $mux = new Pux\Mux;
// $mux->any('/product', ['ProductController','listAction']);
// $mux->get('/product/:id', ['ProductController','itemAction'] , [
//     'require' => [ 'id' => '\d+', ],
//     'default' => [ 'id' => '1', ]
// ]);
// $mux->post('/product/:id', ['ProductController','updateAction'] , [
//     'require' => [ 'id' => '\d+', ],
//     'default' => [ 'id' => '1', ]
// ]);
// $mux->delete('/product/:id', ['ProductController','deleteAction'] , [
//     'require' => [ 'id' => '\d+', ],
//     'default' => [ 'id' => '1', ]
// ]);
// $route = $mux->dispatch('/product/1');
// Executor::execute($route);