<?php

class newsItem extends Model
{
    public $product;

    protected $sample = [
        'id', 'name', 'system', 'mod_pid', 'mod_name', 'balance', 'article', 
        'category', 'infinity', 'photo', 'price', 'old_price', 'manufacturer'
    ];

    public function __construct($product = [])
    {
        if (!empty($product))
        {
            $this->product = $this->convertToObject(
                array_intersect_key($product, array_flip($this->sample))
            );
        }
    }

    # Id
    public function getId()
    {
        return $this->product->id;
    }

    # Name
    public function getName()
    {
        return $this->product->name;
    }

    # Price
    public function getPrice()
    {
        return $this->product->price;
    }
}