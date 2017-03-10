<?php

class newsItem extends Model
{
    public $news;

    // public function __construct($news = [])
    // {
    //     // parent::__construct();
    //     // if (!empty($news))
    //     // {
    //     //     $this->news = $this->convertToObject(
    //     //         array_intersect_key($news, array_flip($this->sample))
    //     //     );
    //     // }
    // }

    public function getId()
    {
        return $this->news->id;
    }

    public function getName()
    {
        return $this->news->name;
    }

    public function getPrice()
    {
        return $this->news->price;
    }
}