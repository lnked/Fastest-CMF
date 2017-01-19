<?php declare(strict_types = 1);

return [
    
];

// public function index()
// {
//     if (isset($this->arguments[1]))
//     {
//         return $this->errorPage;
//     }

//     if (isset($this->arguments[0]))
//     {
//         return $this->itemMethod(intval($this->arguments[0]));
//     }
    
//     return $this->listMethod();
// }

// $r->get('/news', ['newsModule', 'listAction']);

// $r->get('/news/:id', ['newsModule', 'itemAction'], [
//     'require' => [ 'id' => '\d+' ]
// ]);

// $r->get('/articles', function(){
//     return [
//         'template'  =>  'list'
//     ];
// });

// $r->get('/articles/:category', function($category) {

//     return [
//         'article'   =>  $category,
//         'template'  =>  'list'
//     ];
    
//     return 'category: ' . $category;
// }, [
//     'require' => [ 'category' => '\S+' ]
// ]);

// $r->get('/articles/:category/:id', function($category, $id) {

//     return [
//         'article'   =>  $id,
//         'template'  =>  'list'
//     ];

//     // return $category . ' as ' . $id;

// }, [
//     'require' => [ 'category' => '\S+', 'id' => '\d+' ]
// ]);
