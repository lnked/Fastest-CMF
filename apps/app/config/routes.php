<?php

// https://c9s.github.io/Pux/

use Pux\Mux;
// use Pux\Executor;
// use Pux\RouteExecutor as Executor;

$r = new Pux\Mux;

$r->get('/', function(){
    return ('main');
});

$r->get('/hello', function(){
    return ('hello');
});

$r->get('/news', ['NewsController', 'listAction']);

$r->get('/news/:id', ['NewsController', 'itemAction'], [
    'require' => [ 'id' => '\d+' ]
]);

$r->get('/articles', function(){
    return ('articles');
});

$r->get('/articles/:id', function($id) {
    return $id;
}, [
    'require' => [ 'id' => '\d+', ]
]);

// $mux = new Pux\Mux;
// $mux->mount( '/product' , $controller->expand() );

// $mux->dispatch('/product');       // ProductController->indexAction
// $mux->dispatch('/product/add');   // ProductController->addAction
// $mux->dispatch('/product/del');   // ProductController->delAction

$r->sort();

return $r;