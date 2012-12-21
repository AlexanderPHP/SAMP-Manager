<?php

 // namespace SAMP_Manager;

class Account{
	
	private $db;
	public  $Auth,
			$uData;
	
	public function __construct($db)
	{	
		
		$this->db = $db;
	
		if(isset($_COOKIE['pwd']) && isset($_COOKIE['uid']))
		{
			$pass = $this->db->fetchAssoc('SELECT `password` FROM `site_users` WHERE `id` = ?',array($_COOKIE['uid']));

			if(!empty($pass) && $pass[0]['key'] == $_COOKIE['pwd'])
			{
				$this->uData = $this->db->fetchAssoc('SELECT `id`,`name`,`email`,`group`,`avatar` FROM `site_users` WHERE `id` = ?',array($_COOKIE['uid']));
				/* $this->db->update('game_users',array('last_visit'),' SET `last_visit` = CURRENT_TIMESTAMP WHERE `id` = :id',array(':id'=>$_COOKIE['uid'])); последнее посещение */

				$this->Auth = true;
			}
		}
		else
		{
			$this->Auth = false;
		}
	
	}
	
	public function ValidateUser($name,$password,$email)
	{
		$err = '';
		
 		if(strlen($name) > 24) $err .= 'Имя не должно превышать 24 символов.<br>';
		
		if(!preg_match('/^[A-Z][a-z]+_[A-Z][a-z]+$/',$name)) $err .= "Введите корректное имя. Например: 'Vito_Corleone' или 'Frank_Costello'.<br>";
		
		
		if($this->isIssetUser($name,'login')) $err .= 'Такое имя уже зарегистрировано.<br>';
		
		if(!preg_match('/^[A-Za-z0-9]+$/',$password) || (strlen($password) < 4 || strlen($password) > 16)) $err .= 'Пароль должен содержать только латинские буквы и цифры, а так же не должен быть короче 4 и длиннее 16 символов.<br>';
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			if($this->isIssetUser($email,'email'))
				
				$err .= 'Данный E-mail уже зарегистрирован.<br>';
		}
		else
			$err .= 'Введите корректный E-mail.<br>';
		 
		if(empty($err))
			$this->RegisterUser($name,$password,$email);
		else
			return $err;
	}
	
	private function isIssetUser($data,$opt)
	{
		if(in_array($opt),array('email','name'))
		{
			if($this->db->fetchAssoc('SELECT `id` FROM `site_users` WHERE `'.$opt.'` = ?',array($data)))
				
				return true;
		}
		
		return false;
	}
	
	private function RegisterUser($name,$password,$email)
	{
		$this->db->insert('site_users','name'=>$name,'password'=>md5($password),'email'=>$email);
		Main::Db()->noResult('INSERT INTO `site_users`(`name`,`key`,`email`) VALUES(:name,:key,:email)',array(':name'=>$name,':key'=>md5($password),':email'=>$email));
		$this->SentValidateEmail($name,$email,$this->ValidateEmailID($name),strlen($password));
		$this->Login($name, $password);
        //header('Location: index.php');
		
	}
	
	private function ValidateEmailID($name)
	{
		$code = strtoupper(md5(uniqid(microtime(),1)));
		$this->db->noResult("UPDATE `site_users` SET `activate_code` = '".$code."' WHERE `name` = :name",array(':name'=>$name));
		return $code;
	}
	
	private function SentValidateEmail($name,$email,$code,$pwdlen)
	{	
		for($i=0,$pwd ='';$i<$pwdlen;$i++) $pwd .='*';
		$text=<<<TEXT
			Благодарим Вас за регистрацию на сайте <a href="http://beautifullife-rp.ru" target="_blank">BeautifulLife Role Play</a>
			<br>
			<br>
			Ваш логин для входа в систему: <b>{$name}</b>
			<br>
			Ваш пароль для входа в систему: <b>{$pwd}</b><br>
			<br>
			<br>
			Для того чтобы зайти в систему, вам надо сначала активировать вашу учетную запись.
			<br>
			Для этого необходимо перейти по следующей ссылке: <a href="http://beautifullife-rp.ru/activate/{$name}/{$code}" target="_blank">http://beautifullife-rp.ru/activate/{$name}/{$code}</a><br>
			Внимание! Перейдя по данной ссылке Вы подтверждаете, что Вам уже есть 16 лет, а так же соглашаетесь с правилами Нашего Сайта!
                        <br><br>
			С уважением, <a href="http://beautifullife-rp.ru" style="color:#080" target="_blank">Администрация BeautifulLife Role Play</a>.<br><br>
			<span>Данное письмо отправлено автоматически, отвечать на него не нужно. За всеми интересующими Вас вопросами обращайтесь на <b>support@beautifullife-rp.ru</b></span>
TEXT;
		$subject="=?windows-1251?B?". base64_encode("Подтверждение регистрации на BeautifulLife-Rp.ru"). "?=";
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
			$ucode = $this->db->getResult('SELECT `activate_code` FROM `site_users` WHERE `name` = :name',array(':name'=>$uname))[0]['activate_code'];
		  
			if($code == $ucode)
			{
				$this->db->noResult('UPDATE `site_users` SET `group` = 1 WHERE `name` = :name',array(':name'=>$uname));
				header("Location: http://".$_SERVER['SERVER_NAME']);
			}
		}
    }
	
	public function Login($name,$password)
	{
		if($this->isIssetUser($name,'login'))
		{
			$data = $this->db->getResult('SELECT `key`,`id` FROM `site_users` WHERE `name` = :name',array(':name'=>$name));
			
			if($data[0]['key'] == md5($password))
			{
				
				setcookie('pwd',md5($password), time()+1000000,'/');
				setcookie('uid',$data[0]['id'], time()+1000000,'/');
				
				header("Location: http://".$_SERVER['SERVER_NAME']);
				
			}
			else
				echo 'Неверный пароль!';
		}
		else
			echo 'Пользоватьель с таким именем не существует.';
	}
	
/* 	public function Logout()
	{
		if($this->Auth)
		{
			setcookie('pwd','', time()-3600,'/');
			setcookie('uid','', time()-3600,'/');		
			$this->Auth = false;
		}
			header("Location: http://".$_SERVER['SERVER_NAME']);
	} */
	
	public function UserEditActions($type,$uname)
	{
		if($this->isIssetUser($uname,'game'))
		{
			switch($type)
			{
				case 'mute': 
							if($this->CheckUserAction($type,$uname))
							{
								$this->db->noResult('UPDATE `game_users` SET `muted` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' заткнут.';
							}
							else
							{
								$this->db->noResult('UPDATE `game_users` SET `muted` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' больше не заткнут.';
							}
				break;
						
				case 'jail':
							if($this->CheckUserAction($type,$uname))
							{ 
								$this->db->noResult('UPDATE `game_users` SET `jailed` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' посажен в тюрьму.';
							}
							else
							{
								$this->db->noResult('UPDATE `game_users` SET `jailed` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' освобожден из тюрьмы.';						
							}
				break;
				
				case 'ban':
							if($this->CheckUserAction($type,$uname))
							{
								$this->db->noResult('UPDATE `game_users` SET `ban` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' забанен.';
							}
							else
							{
								$this->db->noResult('UPDATE `game_users` SET `ban` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' разабанен.';						
							}
				break;	
				
				case 'warn':							
							$result = $this->CheckUserAction($type,$uname);
							if($result == 0)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' получил предупреждение. Количество предупреждений: 1';
							}
							elseif($result == 1)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 2 WHERE `name` = :name',array(':name'=>$uname));
								echo 'Пользователь '.$uname.' получил предупреждение. Количество предупреждений: 2';
							}
							elseif($result == 2)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 3 WHERE `name` = :name',array(':name'=>$uname));
								$this->UserEditActions('ban',$uname);
							}
							elseif($result == 3)
							{
								echo 'Пользователь '.$uname.' уже имеет 3 предупреждения.';
							}
				break;				
				
				case 'unwarn':							
							$result = $this->CheckUserAction($type,$uname);
							if($result == 0)
							{
								echo 'Пользователь '.$uname.' не имеет предупреждений.';
							}
							elseif($result == 1)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 0 WHERE `name` = :name',array(':name'=>$uname));
								echo 'С пользователя '.$uname.' сняты все предупреждения.';
							}
							elseif($result == 2)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 1 WHERE `name` = :name',array(':name'=>$uname));
								echo 'С пользователя '.$uname.' снято предупреждение. Количество предупреждений: 1.';
							}
							elseif($result == 3)
							{
								$this->db->noResult('UPDATE `game_users` SET `warnings` = 2 WHERE `name` = :name',array(':name'=>$uname));
								$this->UserEditActions('ban',$uname);
							}
				break;
				
				// case 'delete':
								// if(Main::$UserData['site']->group >= 4)
								// {
									// $this->db->noResult('DELETE FROM `game_users` WHERE `name` = :name',array(':name'=>$uname));
									// $this->db->noResult('DELETE FROM `site_users` WHERE `name` = :name',array(':name'=>$uname));
									// echo 'Пользователь '.$uname.' был удален.';	
								// }
								// else
								// {
									// echo 'Нехватает прав ;)';
								// }
				// break;
			}
		}
		else
		{
			echo 'Пользователь '.$uname.' не найден.';
		}
	}
	
	private function CheckUserAction($type,$uname)
	{
		switch($type)
		{
			case 'mute': if($this->db->getResult('SELECT `muted` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['muted'] === '0')return true;break;
			
			case 'jail': if($this->db->getResult('SELECT `jailed` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['jailed'] === '0')return true;break;
			
			case 'ban': if($this->db->getResult('SELECT `ban` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['ban'] === '0')return true;break;		
			
			case 'unwarn':
			case 'warn': return $this->db->getResult('SELECT `warnings` FROM `game_users` WHERE `name` = :name',array(':name'=>$uname))[0]['warnings'];
		}
		
		return false;
	}

}