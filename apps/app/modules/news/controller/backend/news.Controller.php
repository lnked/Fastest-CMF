<?php

class NewsController extends newsItem
{
    public function __construct()
    {
        exit(__("news controllers", $this));
    }

    public function listAction()
    {
        return 'product list';
    }

    public function itemAction($id)
    { 
        return "product $id";
    }
}