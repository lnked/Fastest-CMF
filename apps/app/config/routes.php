<?php

// https://c9s.github.io/Pux/

use Pux\Mux;

$r = new Pux\Mux;

$r->get('/', function(){
    return ('main');
});

$r->get('/hello', function(){
    return ('hello');
});

$r->get('/news', ['newsModule', 'listAction']);

$r->get('/news/:id', ['newsModule', 'itemAction'], [
    'require' => [ 'id' => '\d+' ]
]);

$r->get('/articles', function(){
    return 'articles';
});

$r->get('/articles/:category', function($category) {
    return 'category: ' . $category;
}, [
    'require' => [ 'category' => '\S+' ]
]);

$r->get('/articles/:category/:id', function($category, $id) {
    return $category . ' as ' . $id;
}, [
    'require' => [ 'category' => '\S+', 'id' => '\d+' ]
]);

// $r->mount( '/product' , $controller->expand() );
// $r->dispatch('/product');       // ProductController->indexAction
// $r->dispatch('/product/add');   // ProductController->addAction
// $r->dispatch('/product/del');   // ProductController->delAction

// $r->sort();

return $r;