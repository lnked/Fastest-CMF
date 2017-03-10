<?php

// class Model extends Module
class Model extends Initialize
{
	public $item;

	public $schema;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Получение и установка свойств объекта через вызов магического метода вида:
     * $object->(get|set)PropertyName($prop);
     *
     * @see __call
     * @return mixed
     */
    public function __call($method_name, $argument)
    {
        $args = preg_split('/(?<=\w)(?=[A-Z])/', $method_name);
        $action = array_shift($args);
        $property_name = strtolower(implode('_', $args));

        switch ($action)
        {
            case 'get':
                return isset($this->$property_name) ? $this->$property_name : null;

            case 'set':
                $this->$property_name = $argument[0];
                return $this;
        }
    }

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