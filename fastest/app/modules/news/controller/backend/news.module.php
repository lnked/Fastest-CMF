<?php

final class newsModule extends newsItem
{
    public function listAction()
    {
        $news = [
            ['item' => 1],
            ['item' => 2]
        ];

        return [
            'news'      =>  $news,
            'template'  =>  'index'
        ];
    }

    public function itemAction($id)
    {
        $news = [
            'item' => $id
        ];

        return [
            'news'      =>  $news,
            'template'  =>  'item'
        ];
    }
}