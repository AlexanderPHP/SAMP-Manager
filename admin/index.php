<?php

spl_autoload_register(function($class)
{
    include_once($_SERVER['DOCUMENT_ROOT'] .'/core/classes/' . $class . '.class.php');        
});
Main::set('Tpl', new Template());
Main::set('Db', new DB('beautifuldb','root','','localhost'));
Main::set('Account', new Account());

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