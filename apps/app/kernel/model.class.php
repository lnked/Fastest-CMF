<?php

// class Model extends Module
class Model extends Initialize
{
	public $item;

	public $schema;

    public function __construct() {}

	public static function set($item = [])
	{
        if (!empty($item))
        {
            $this->item = $this->convertToObject(
                array_intersect_key($item, array_flip($this->schema))
            );
        }
	}

	public static function convertToObject($a = [])
	{
		if (is_array($a) && !empty($a))
		{
		    $object = new stdClass();

		    foreach ($a as $k => $v)
		    {
		        if (is_array($v))
		        {
		            $v = self::convertToObject($v);
		        }

		        $object->$k = $v;
		    }
		    
		    $a = $object;
		}

		return $a;
	}
}