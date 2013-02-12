<?php
spl_autoload_register(function($class)
{
    include_once(__DIR__ .'/classes/' . $class . '.class.php');        
});
Main::set('Tpl', new Template());
Main::set('Db', new DB('beautifuldb','root','','localhost'));
Main::set('Account', new Account());
Main::set('News', new News(5));

Main::Tpl()->Path = 'http://'.$_SERVER['SERVER_NAME'];

Main::Account();

if(isset($_POST['action']))
{
	if(isset($_POST['name'],$_POST['password'],$_POST['email'],$_POST['key']) && $_POST['action'] == 'gamereg' && $_POST['key'] == '5H6734391Pt8QV4c9!n21Vp24jy05aPf')
	{
		 Main::Account()->ValidateUser($_POST['name'],$_POST['password'],$_POST['email']);
		 //file_put_contents('log.log', implode("\n",$_POST), FILE_APPEND);
	}
}

if(Main::$Auth && !Main::$UserData['site']->group)
{
    if(isset($_GET['action']))
    {
        switch ($_GET['action'])
        {
            case 'logout':  Main::Account()->Logout();break;
                
            case 'activate': isset($_GET['uname'],$_GET['code']) ? Main::Account()->ActivateAccount($_GET['uname'],$_GET['code']): '';break;
        }
    }
    Main::Tpl()->compile('offline.php');
    die();   
}

    if(isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case 'login': if(isset($_POST['login_name'],$_POST['login_password'])) $login = Main::Account()->Login($_POST['login_name'],$_POST['login_password']);break;

            case 'logout': if(Main::$Auth) Main::Account()->Logout();die();

            case 'register': if(isset($_POST['name'],$_POST['password'],$_POST['email'])) Main::Account()->ValidateUser($_POST['name'],$_POST['password'],$_POST['email']);break;

            case 'addnews': if(isset($_POST['title'],$_POST['short_news'],$_POST['full_news'])) Main::News()->AddNews($_POST['title'],$_POST['short_news'],$_POST['full_news']);break;

            case 'ratenews': if(Main::$Auth) isset($_GET['up']) ? Main::News()->RateNews($_GET['up'],'up') : isset($_GET['down']) ? Main::News()->RateNews($_GET['down'],'down'):'';break;

            case 'fullnews': if(Main::$Auth && isset($_GET['newsid'])) Main::Tpl()->FullNews = Main::News()->getNews('full',$_GET['newsid']);break;
			
			case 'viewprofile': if(isset($_GET['uname'])) Main::Tpl()->pUser = Main::Account()->getProfile($_GET['uname']);break;
			
			case 'activate': isset($_GET['uname'],$_GET['code']) ? Main::Account()->ActivateAccount($_GET['uname'],$_GET['code']): '';break;

        }
    }

    /* !!!!! */
        Main::Tpl()->Pages = Main::News()->getPagination(isset($_GET['page']) ? $_GET['page'] : 1);

        Main::Tpl()->ShortNews = Main::News()->getNews('short');

        Main::Tpl()->Navig = Main::News()->Navig;	
    /* !!!!! */
	
Main::Tpl()->Auth = Main::$Auth;

Main::Tpl()->User = Main::$UserData;

Main::Tpl()->TopNews = Main::News()->getNews('top');

Main::Tpl()->compile();
?>