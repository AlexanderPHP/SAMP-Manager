<?php

class Main{

	static	public  $Auth = false, # Авторизация
					$UserData = array(), # Пользовательские данные
					$NewsData = array(); # Новости

	private static $registry = array();
	
	public static function set($key, $object)
	{
		if(!in_array($object,self::$registry))
		{
			self::$registry[$key] = $object;
		}
		else
		{
			throw new Exception('Error: Object Already Created');
		}
	}
	
	public static function __callStatic($name, $args)
	{
		if(array_key_exists($name,self::$registry))
		{
			return self::$registry[$name];
		}
		else
		{
			//throw new Exception('Error: Object Does Not Exists');
		}
	}
	
    private function __wakeup(){}
 
    private function __construct(){}
 
    private function __clone(){}	
}
?>