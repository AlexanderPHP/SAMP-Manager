<?php
function autoload($class)
{
    include_once($_SERVER['DOCUMENT_ROOT'] .'/core/classes/' . $class . '.class.php');        
}
spl_autoload_register("autoload");
Main::Account();
	if(Main::$UserData['site']->group >= 3)
	{
		Main::Tpl()->Auth = Main::$Auth;
		Main::Tpl()->Users = Main::Account()->getUsers();
		Main::Tpl()->Path = 'http://'.$_SERVER['SERVER_NAME'];
		Main::Tpl()->User = Main::$UserData;
		Main::Tpl()->compile('admin.php');
	}
	else
	{
		header('Location: http://'.$_SERVER['SERVER_NAME']);
	}
?>