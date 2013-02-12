<?php

spl_autoload_register(function($class)
{
    include_once(__DIR__ .'/core/classes/' . $class . '.class.php');        
});
Main::set('Db', new DB('beautifuldb','root','','localhost'));
Main::set('Account', new Account());

Main::Account();
	if(Main::$Auth && Main::$UserData['site']->group >= 3)
	{
		if(isset($_POST['type']))
		{
		
			switch($_POST['type'])
			{
				
				case 'usereditaction':
					if(isset($_POST['action'],$_POST['uname']))
					{
						
						Main::Account()->UserEditActions($_POST['action'],$_POST['uname']);
					
					}
				break;
				
				default: echo 'Undefined Action Type';
			
			}
		
		}

	}
	else
	{
		die('Ќехватает прав дл€ совершени€ действи€!');
	}
?>