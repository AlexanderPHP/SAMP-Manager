<?php
class DB
{
	private  	$conn				=	null;
	public		$error				=	0;

	private 	$show_errors		=	false;
	private 	$stop_after_error	=	false;

	private 	$counter			= 	array(); // $fcount * $rcount
	private 	$fcount 			= 	array();
	private 	$rcount 			= 	array();

	private		$prep=array();

	
	// ***** connect
	public function __construct($database,$user,$pass,$host="localhost",$show_errors = true,$stop_after_error = false, $driver =  array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `cp1251`'))
	{
		$this->show_errors			=	$show_errors;
		$this->stop_after_error		=	$stop_after_error;

		try {
			$this->conn = new PDO("mysql:host={$host};dbname={$database}", $user, $pass, $driver);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			$this->err($e);
			$this->conn = null;
			return false;
		}

		$this->error=0;
		return true;
	}


	
	public function noResult($sql,$params=false,$alias=0)
	{
		if(!$this->is_connected())
			return false;
	
		if(empty($sql))
		{
			$this->error=1;
			return false;
		}

		if(!$this->query($sql,$params) || !($this->prep[$alias] instanceof PDOStatement))
			return false;
			
		$this->get_fields_count($this->prep[$alias],$alias);
		$this->get_records_count($this->prep[$alias],$alias);

		return true;
	}	

	// ***********************************
	// ***** getResult
	public function getResult($sql,$params=false,$fetch_mode=PDO::FETCH_ASSOC,$alias=0)
	{
		if(!$this->is_connected())
		return false;

		if(empty($sql))
		{
			$this->error=1;
			return false;
		}

		$this->counter[$alias]  = 0;
		
		if(!$this->query($sql,$params) || !($this->prep[$alias] instanceof PDOStatement))
		return false;

		$this->get_fields_count($this->prep[$alias],$alias);
		$this->get_records_count($this->prep[$alias],$alias);
		
		$ret=array();
		
		if($fetch_mode == PDO::FETCH_OBJ)
		{
			$ret = $this->prep[$alias]->fetch($fetch_mode);
		}
		else
		{
			while ($row = $this->prep[$alias]->fetch($fetch_mode))
			$ret[] = $row;
		}

		$this->counter[$alias] = $this->fcount[$alias]*$this->rcount[$alias];

		return $ret;
	}	

	// ***********************************
	// ***** query
	public function query($sql,$params=false,$alias=0)
	{
		if(!$this->is_connected()) return false;
		$this->error=0;
		if(is_array($params))
		{
			try
			{
				$this->prep[$alias]= $this->conn->prepare($sql);

				if(count($params[key($params)],0)>1) // Wenn parameters bei Name gesendet
				{
					$lnI=0;
					foreach($params AS $key=>$value)
					{
						foreach($value AS $val)
						{
							$var[$lnI]=$val;
							$lnI++;
						}
						if($lnI>0)
						{
							$this->prep[$alias]->bindParam(':'.$key, $var[0], $var[1], $var[2], $var[3]); // $key- Param. name, 0 - value, 1 - Typ, 2 - Length, 3 drviver options ,
							unset($var);
						}
						$lnI=0;
					}
					$this->prep[$alias]->execute();
				}
				else
				$this->prep[$alias]->execute($params); // Wenn array nur mit values
			}
			catch(PDOException $e)
			{
				$this->err($e,$sql); return false;
			}
		}
		else
		{
			try
			{
				$this->prep[$alias] = $this->conn->query($sql);
			}
			catch(PDOException $e)
			{
				$this->err($e,$sql); return false;
			}
		}
		return true;
	}

	// ***********************************
	// ***** err
	private function err($e, $dop_string='')
	{
		if(is_object($this->conn))
			$this->error=$this->conn->errorCode(); // Get Pdo Error
		else
			$this->error=4; // PDO Objekt existiert nicht

		$err 	= new ERR();
		$err->err_log($e->getMessage()."   ".$dop_string,$this->show_errors,$this->stop_after_error,true);
	}

	// ***********************************
	// ***** is_connected
	public function is_connected()
	{

		if(!is_object($this->conn) || empty($this->conn))
		{
			$this->error=2;
			return false;
		}

		return true;

	}

	// ***********************************
	// ***** quote
	function quote($parameter, $parameter_type = PDO::PARAM_STR)
	{
		 if(is_null($parameter) )
		 	{
      		return "NULL";
    		}

		return $this->conn->quote($parameter, $parameter_type);
	}

	// ***********************************
	// ***** exec
	public function exec($sql)
	{
		if(!$this->is_connected())
		return false;

		$this->error=0;
		try
		{
			return $this->conn->exec($sql);
		}
		catch(PDOException $e)
		{

			$this->err($e,$sql);

			return false;
		}
	}

	// ***********************************
	// ***** count
	public function count($alias=0)
	{
		return $this->counter[$alias];
	}

	// ***********************************
	// ***** rcount
	public function rcount($alias=0)
	{
		return $this->rcount[$alias];
	}

	// ***********************************
	// ***** fcount
	public function fcount($alias=0)
	{
		return $this->fcount[$alias];
	}

	// ***********************************
	// ***** get_fields_count
	private function get_fields_count($res,$alias=0)
	{
		$this->fcount[$alias] = 0;

		if(!is_object($res))
		return 0;

		$this->fcount[$alias] = $res->columnCount();

		return $this->fcount[$alias];
	}

	// ***********************************
	// ***** get_records_count
	private function get_records_count($res,$alias=0)
	{
		$this->rcount[$alias] = 0;

		if(!is_object($res))
		return 0;

		$this->rcount[$alias] =  $res->rowCount();

		return $this->rcount[$alias];
	}

	// ***********************************
	// ***** lastId
	public function lastId($name=null)
	{//$name - name of the sequence object from which the ID should be returned.
		if(!$this->is_connected())
		return false;

		return $this->conn->lastInsertId($name);
	}

	// ***********************************
	// ***** iserror
	public function iserror($res)
	{  // dieses Metot existiert nur für Kompatibilitat mit alte PEAR Bibliothek !!!!
		if($this->error > 0 || (!is_object($res) && !is_array($res) && empty($res)))
		return true;
		else
		return false;
	}
	
	
	// ***********************************
	// ***** __destruct
	function __destruct()
	{
		if(is_object($this->conn))

		$this->conn = null;
	}
}// End Class
?>