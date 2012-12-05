<?php
function autoload($class)
{
    include_once(__DIR__ .'/core/classes/' . $class . '.class.php');        
}
spl_autoload_register("autoload");
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