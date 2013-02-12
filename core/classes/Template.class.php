<?php
class Template{
	private
		$dir = '',
		$source = array();
		
	public function __construct($dir = '/template/'){
		if(is_dir($_SERVER['DOCUMENT_ROOT']  . $dir)){
			$this->dir = $_SERVER['DOCUMENT_ROOT'] . $dir;
			
		}
	}
	
 	public function __set($name, $value){
		$this->source["$name"] = $value;
	}

	public function compile($template = 'main.php'){
		extract($this->source);		
		include ($this->dir . $template);
	}
	
	/* 
	public function load($template, $values){
		if(file_exists($this->dir . $template) && is_array($values)){
			extract($values);
			ob_start();
			include ($this->dir . $template);  
			return ob_get_clean();
		}
	}
	 */
}
?>
