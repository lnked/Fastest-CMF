<?php

class News extends newsItem
{
    // protected $current = '';

    // protected $_page = [
    //     'name' => '',
    //     'no_fixcart' => true
    // ];

    // protected $step = [
    //     'index' => [
    //         'name'      =>  'Корзина',
    //         'system'    =>  'index'
    //     ],
    //     'checkout' => [
    //         'name'      =>  'Оформление заказа',
    //         'system'    =>  'checkout'
    //     ],
    //     'complete' => [
    //         'name'      =>  'Готово',
    //         'system'    =>  'complete'
    //     ]
    // ];

    // protected $required = [ 'name', 'phone', 'city', 'street', 'house' ];

    // public function index()
    // {
    //     if (isset($this->arguments[0]) && !isset($this->step[$this->arguments[0]]))
    //     {
    //         return $this->errorPage;
    //     }

    //     $this->getCurrent();

    //     if (count($_POST))
    //     {
    //         $this->handle($_POST);
    //     }

    //     return $this->orderMethod();
    // }

    // private function getProduct($id)
    // {
    //     return Q("SELECT * FROM `#__shop_catalog` WHERE `id`=?i AND `visible`=?i LIMIT 1", [ $id, 1 ])->row();
    // }

    // private function getProductId()
    // {
    //     if (isset($_GET['product']))
    //     {
    //         return intval($_GET['product']);
    //     }

    //     if (isset($_POST['product']))
    //     {
    //         return intval($_POST['product']);
    //     }

    //     return false;
    // }

    // private function getProductCount()
    // {
    //     if (isset($_GET['count']))
    //     {
    //         return intval($_GET['count']);
    //     }

    //     if (isset($_POST['count']))
    //     {
    //         return intval($_POST['count']);
    //     }

    //     return 1;
    // }

    // public function addMethod()
    // {
    //     $product_id = $this->getProductId();
    
    //     if ($product_id)
    //     {
    //         $this->addItem(new cartItem($this->getProduct($product_id)));

    //         if ($this->isAjax())
    //         {
    //             $response = $this->response();
    //             exit(json_encode($response, 64 | 256));
    //         }
    //         else
    //         {
    //             if (isset($_GET['backuri']))
    //             {
    //                 redirect(base64_decode($_GET['backuri']));
    //             }
    //         }
    //     }
    // }

    // public function removeMethod()
    // {
    //     $product_id = $this->getProductId();

    //     if ($product_id)
    //     {
    //         $this->deleteItem(new cartItem($this->getProduct($product_id)));

    //         if ($this->isAjax())
    //         {
    //             $response = $this->response();
    //             $response['remove'] = $product_id;
    //             exit(json_encode($response, 64 | 256));
    //         }
    //         else
    //         {
    //             redirect('/');
    //         }
    //     }
    // }

    // public function updateMethod()
    // {
    //     $product_id = $this->getProductId();

    //     if ($product_id)
    //     {
    //         $count = $this->getProductCount();
    //         $product = $this->getProduct($product_id);

    //         $this->updateItem(new cartItem($product), $count);

    //         if ($this->isAjax())
    //         {
    //             $response = $this->response();
    //             $response['total'] = intval($count) * $product['price'];

    //             exit(json_encode($response, 64 | 256));
    //         }

    //         exit(json_encode($this->response(), 64 | 256));
    //     }
    // }

    // public function clearMethod()
    // {
    //     unset($this->items);
    //     $this->save();

    //     redirect('/' . $this->module_root);
    // }

    // public function orderMethod()
    // {
    //     $response = [];

    //     $response['list'] = $this->cartContent();
    //     $response['result'] = $this->response();

    //     if (!empty($response['list']))
    //     {
    //         $this->_page['no_sidebar'] = true;
    //     }

    //     return array(
    //         'page'      =>  $this->_page,
    //         'current'   =>  $this->current,
    //         'order'     =>  $response,
    //         'template'  =>  'index'
    //     );
    // }

    // public function checkoutMethod()
    // {
    //     $response = [];
    //     $response['result'] = $this->response();

    //     $this->getCurrent();
        
    //     $this->_page['no_sidebar'] = true;
        
    //     $data = [];
    //     $errors = [];

    //     if (isset($_SESSION[$this->current['system']]['data']))
    //     {
    //         $data = $_SESSION[$this->current['system']]['data'];
    //     }
        
    //     if (isset($_SESSION[$this->current['system']]['errors']))
    //     {
    //         $errors = $_SESSION[$this->current['system']]['errors'];
    //     }
        
    //     return array(
    //         'page'      =>  $this->_page,
    //         'current'   =>  $this->current,
    //         'order'     =>  $response,
    //         'data'      =>  $data,
    //         'errors'    =>  $errors,
    //         'template'  =>  'checkout'
    //     );
    // }
 
    // public function completeMethod()
    // {
    //     $this->getCurrent();

    //     $this->_page['no_sidebar'] = true;

    //     return array(
    //         'page'      =>  $this->_page,
    //         'current'   =>  $this->current,
    //         'template'  =>  'complete'
    //     );
    // }
}