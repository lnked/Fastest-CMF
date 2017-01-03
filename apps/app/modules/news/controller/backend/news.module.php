<?php

final class newsModule extends newsItem
{
    public function listAction()
    {
        return 'news list';
    }

    public function itemAction($id)
    { 
        return "news item id: $id";
    }
}