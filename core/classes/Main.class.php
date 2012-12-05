<?php

class Main{
	static public $DbInst = null, # ������ ������ ��
				  $TplInst = null, # ������ ������ "�������������"
				  $AccountInst = null, # ������ ������ �����������/�����������
				  $NewsInst = null, # ������ ������ ��������
				 
				  $Auth = false, # �����������
				  $UserData = array(), # ���������������� ������
				  $NewsData = array(); # �������
	
	const DB_NAME = 'beautifuldb';
	const DB_USER = 'root';
	const DB_PWD = '';
	const DB_HOST = 'localhost';
	
	private function __construct(){}
	
	public static function __callStatic($name,$args)
	{
		switch($name)
		{
			case 'Db':
						if(is_null(self::$DbInst))
							self::$DbInst = new DB(self::DB_NAME,self::DB_USER,self::DB_PWD,self::DB_HOST);
						
						return self::$DbInst;
			
			case 'Tpl':
						if(is_null(self::$TplInst))
							self::$TplInst = new Template();
						
						return self::$TplInst;	
			
			case 'Account':	
						if(is_null(self::$AccountInst))
							self::$AccountInst = new Account();
							
						return self::$AccountInst;
			
			case 'News':
						if(is_null(self::$NewsInst))
							self::$NewsInst = new News(5);
						
						return self::$NewsInst;
		}				
	}
}
?>