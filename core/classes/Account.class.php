<?php

class Account{
	
	public function __construct()
	{	
		if(isset($_COOKIE['pwd']) && isset($_COOKIE['uid']))
		{
			$pass = Main::Db()->getResult('SELECT `key` FROM `site_users` WHERE `id` = :id',array(':id'=>$_COOKIE['uid']));

			if(!empty($pass) && $pass[0]['key'] == $_COOKIE['pwd'])
			{
				Main::$UserData['site'] = Main::Db()->getResult('SELECT `id`,`name`,`email`,`group`,`avatar` FROM `site_users` WHERE `id` = :id',array(':id'=>$_COOKIE['uid']),PDO::FETCH_OBJ);
				Main::Db()->noResult('UPDATE `game_users` SET `last_visit` = CURRENT_TIMESTAMP WHERE `id` = :id',array(':id'=>$_COOKIE['uid']));

				Main::$Auth = true;
			}
		}
		else
		{
			Main::$Auth = false;
		}
	
	}
	
	public function ValidateUser($name,$password,$email)
	{
		$err = '';
		
 		if(strlen($name) > 24) $err .= '��� �� ������ ��������� 24 ��������.<br>';
		
		if(!preg_match('/^[A-Z][a-z]+_[A-Z][a-z]+$/',$name)) $err .= "������� ���������� ���. ��������: 'Vito_Corleone' ��� 'Frank_Costello'.<br>";
		
		
		if($this->isIssetUser($name,'login')) $err .= '����� ��� ��� ����������������.<br>';
		
		if(!preg_match('/^[A-Za-z0-9]+$/',$password) || (strlen($password) < 4 || strlen($password) > 16)) $err .= '������ ������ ��������� ������ ��������� ����� � �����, � ��� �� �� ������ ���� ������ 4 � ������� 16 ��������.<br>';
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			if($this->isIssetUser($email,'email'))
				
				$err .= '������ E-mail ��� ���������������.<br>';
		}
		else
			$err .= '������� ���������� E-mail.<br>';
		 
		if(empty($err))
			$this->RegisterUser($name,$password,$email);
		else
			return $err;
	}
	
	private function isIssetUser($data,$opt)
	{
		switch($opt)
		{
			case 'email': Main::Db()->getResult('SELECT `id` FROM `site_users` WHERE `email` = :email',array(':email'=>$data));break;
				
			case 'login': Main::Db()->noResult('SELECT `id` FROM `site_users` WHERE `name` = :name',array(':name'=>$data));break;
			
			case 'game': Main::Db()->noResult('SELECT `id` FROM `game_users` WHERE `name` = :name',array(':name'=>$data));break;
		}
		if(Main::Db()->rcount()) return true;
		
		return false;
	}
	
	private function RegisterUser($name,$password,$email)
	{
		////////////////////////////////////////// TODO PhoneNr//////////////////////////////////////////// 	
		Main::Db()->noResult('INSERT INTO `site_users`(`name`,`key`,`email`) VALUES(:name,:key,:email)',array(':name'=>$name,':key'=>md5($password),':email'=>$email));
		Main::Db()->noResult("INSERT INTO `game_users`(`name`,`key`,`phonenr`,`pdatareg`,`pipreg`,`pip`) VALUES(:name,:password,".rand(100000,999999).",'".date('Y-m-d')."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."')",array(':name'=>$name,':password'=>strtoupper(md5($password))));
		$this->SentValidateEmail($name,$email,$this->ValidateEmailID($name),strlen($password));
		$this->Login($name, $password);
        //header('Location: index.php');
		
	}
	
	private function ValidateEmailID($name)
	{
		$code = strtoupper(md5(uniqid(microtime(),1)));
		Main::Db()->noResult("UPDATE `site_users` SET `activate_code` = '".$code."' WHERE `name` = :name",array(':name'=>$name));
		return $code;
	}
	
	private function SentValidateEmail($name,$email,$code,$pwdlen)
	{	
		for($i=0,$pwd ='';$i<$pwdlen;$i++) $pwd .='*';
		$text=<<<TEXT
			���������� ��� �� ����������� �� ����� <a href="http://beautifullife-rp.ru" target="_blank">BeautifulLife Role Play</a>
			<br>
			<br>
			��� ����� ��� ����� � �������: <b>{$name}</b>
			<br>
			��� ������ ��� ����� � �������: <b>{$pwd}</b><br>
			<br>
			<br>
			��� ���� ����� ����� � �������, ��� ���� ������� ������������ ���� ������� ������.
			<br>
			��� ����� ���������� ������� �� ��������� ������: <a href="http://beautifullife-rp.ru/activate/{$name}/{$code}" target="_blank">http://beautifullife-rp.ru/activate/{$name}/{$code}</a><br>
			��������! ������� �� ������ ������ �� �������������, ��� ��� ��� ���� 16 ���, � ��� �� ������������ � ��������� ������ �����!
                        <br><br>
			� ���������, <a href="http://beautifullife-rp.ru" style="color:#080" target="_blank">������������� BeautifulLife Role Play</a>.<br><br>
			<span>������ ������ ���������� �������������, �������� �� ���� �� �����. �� ����� ������������� ��� ��������� ����������� �� <b>support@beautifullife-rp.ru</b></span>
TEXT;
		$subject="=?windows-1251?B?". base64_encode("������������� ����������� �� BeautifulLife-Rp.ru"). "?=";
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=windows-1251";
		$headers[] = "From: No Reply <noreply@beautifullife-rp.ru>";
		$headers[] = "Reply-To: Reply To <support@beautifullife-rp.ru>";
		$headers[] = "X-Mailer: PHP/".phpversion();
		$headers[] = "X-Priority: 1\n";

		mail($email, $subject, $text, implode("\r\n", $headers));
	}
        
    public function ActivateAccount($uname,$code)
    {
		if($this->isIssetUser($uname,'login'))
		{
			$ucode = Main::Db()->getResult('SELECT `activate_code` FROM `site_users` WHERE `name` = :name',array(':name'=>$uname))[0]['activate_code'];
		  
			if($code == $ucode)
			{
				Main::Db()->noResult('UPDATE `site_users` SET `group` = 1 WHERE `name` = :name',array(':name'=>$uname));
				header("Location: http://".$_SERVER['SERVER_NAME']);
			}
		}
    }
	
	public function Login($name,$password)
	{
		if($this->isIssetUser($name,'login'))
		{
			$data = Main::Db()->getResult('SELECT `key`,`id` FROM `site_users` WHERE `name` = :name',array(':name'=>$name));
			
			if($data[0]['key'] == md5($password))
			{
				
				setcookie('pwd',md5($password), time()+1000000,'/');
				setcookie('uid',$data[0]['id'], time()+1000000,'/');
				
				header("Location: http://".$_SERVER['SERVER_NAME']);
				
			}
			else
				echo '�������� ������!';
		}
		else
			echo '������������� � ����� ������ �� ����������.';
	}
	
	public function Logout()
	{
		if(Main::$Auth)
		{
			setcookie('pwd','', time()-3600,'/');
			setcookie('uid','', time()-3600,'/');		
			Main::$Auth = false;
		}
			header("Location: http://".$_SERVER['SERVER_NAME']);
	}
	
	public function getProfile($user)
	{
		if($this->isIssetUser($user,'login'))
		{
			return Main::Db()->getResult("SELECT `name`,DATE_FORMAT(`pdatareg`,'%e %M %Y') as `pdatareg`,DATE_FORMAT(`last_visit`,'%e %M %Y') as `last_visit`,`level`,`sex` FROM `game_users` WHERE `name` = :name",array(':name'=>$user))[0];
		}
	}
	
	public function getUsers()
	{
		return Main::Db()->getResult('SELECT `name`,`level`,`pip`,`jailed`,`warnings`,`ban`,`muted`,`adminlevel` FROM `game_users`');
	}
	
	public function UserEditActions($type,$uname)
	{
		if($this->isIssetUser($uname,'game'))
		{
			switch($type)
			{
				case 'mute': 
							if($this->CheckUserAction($type,$uname))
							{
								Main::Db()->noResult('UPDATE `game_users` SET `muted` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' �������.';
							}
							else
							{
								Main::Db()->noResult('UPDATE `game_users` SET `muted` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ������ �� �������.';
							}
				break;
						
				case 'jail':
							if($this->CheckUserAction($type,$uname))
							{ 
								Main::Db()->noResult('UPDATE `game_users` SET `jailed` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ������� � ������.';
							}
							else
							{
								Main::Db()->noResult('UPDATE `game_users` SET `jailed` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ���������� �� ������.';						
							}
				break;
				
				case 'ban':
							if($this->CheckUserAction($type,$uname))
							{
								Main::Db()->noResult('UPDATE `game_users` SET `ban` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' �������.';
							}
							else
							{
								Main::Db()->noResult('UPDATE `game_users` SET `ban` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ���������.';						
							}
				break;	
				
				case 'warn':							
							$result = $this->CheckUserAction($type,$uname);
							if($result == 0)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ������� ��������������. ���������� ��������������: 1';
							}
							elseif($result == 1)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 2 WHERE `name` = :name',array(':name'=>$uname));
								echo '������������ '.$uname.' ������� ��������������. ���������� ��������������: 2';
							}
							elseif($result == 2)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 3 WHERE `name` = :name',array(':name'=>$uname));
								$this->UserEditActions('ban',$uname);
							}
							elseif($result == 3)
							{
								echo '������������ '.$uname.' ��� ����� 3 ��������������.';
							}
				break;				
				
				case 'unwarn':							
							$result = $this->CheckUserAction($type,$uname);
							if($result == 0)
							{
								echo '������������ '.$uname.' �� ����� ��������������.';
							}
							elseif($result == 1)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo '� ������������ '.$uname.' ����� ��� ��������������.';
							}
							elseif($result == 2)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo '� ������������ '.$uname.' ����� ��������������. ���������� ��������������: 1.';
							}
							elseif($result == 3)
							{
								Main::Db()->noResult('UPDATE `game_users` SET `warnings` = 2 WHERE `name` = :name',array(':name'=>$uname));
								$this->UserEditActions('ban',$uname);
							}
				break;
				
				case 'delete':
								if(Main::$UserData['site']->group >= 4)
								{
									Main::Db()->noResult('DELETE FROM `game_users` WHERE `name` = :name',array(':name'=>$uname));
									Main::Db()->noResult('DELETE FROM `site_users` WHERE `name` = :name',array(':name'=>$uname));
									echo '������������ '.$uname.' ��� ������.';	
								}
								else
								{
									echo '��������� ���� ;)';
								}
				break;
			}
		}
		else
		{
			echo '������������ '.$uname.' �� ������.';
		}
	}
	
	private function CheckUserAction($type,$uname)
	{
		switch($type)
		{
			case 'mute': if(Main::Db()->getResult('SELECT `muted` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['muted'] === '0')return true;break;
			
			case 'jail': if(Main::Db()->getResult('SELECT `jailed` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['jailed'] === '0')return true;break;
			
			case 'ban': if(Main::Db()->getResult('SELECT `ban` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['ban'] === '0')return true;break;		
			
			case 'unwarn':
			case 'warn': return Main::Db()->getResult('SELECT `warnings` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['warnings'];
		}
		
		return false;
	}

}