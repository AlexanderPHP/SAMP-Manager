<?php
//namespace Manager;
class Test
{
	public $var = 'Привет';
	public $app = 'Привет';
	
	public function __construct($app)
	{
		$this->app = $app;
		return $this->app;
	}
	
	public static function test(){return 'echo';}
}