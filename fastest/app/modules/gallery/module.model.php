<?php declare(strict_types = 1);

class galleryModel extends Model
{
    public $gallery;

    public function __construct($gallery = [])
    {
        if (!empty($gallery))
        {
            $this->gallery = $this->convertToObject(
                array_intersect_key($gallery, array_flip($this->schema))
            );
        }
    }

    public function getId()
    {
        return $this->gallery->id;
    }

    public function getName()
    {
        return $this->gallery->name;
    }

    public function getPrice()
    {
        return $this->gallery->price;
    }
}