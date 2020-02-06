<?php
/*
* .pconf file reader By S·c
* String $file: The .ini file to open
*/
class Config{
	
	public function __construct($file){
		try{
			$this->_File = $file;
			$this->_Content = file_get_contents($file);
			$this->analyze();
		}catch(Exception $e){
			throw($e);
		}
	}
	
	private function analyze(){
		$tmp = explode("\n",$this->_Content);
		//var_dump($tmp);
		foreach($tmp as $i){
			$i = explode("=",$i,2);
			//var_dump($i);
			//var_dump($this->_Config);
			if(isset($i[1]))
			{
				$this->_Config["{$i[0]}"]=$i[1];
			}
			else{
				$this->_Config["{$i[0]}"]="";
			}
		}
	}
	//$key: the section to get
	public function get($key){
		if(isset($this->_Config[$key])){
			return [true,$this->_Config[$key]];
		}
		return [false];
	}
	
	//$key: the section to get
	//$value: the section's value
	//Warning: Don't  forget to save!
	public function set($key,$vale){
		$this->_Config[$key]=$vale;	
	}
	
	//Save the file
	public function save(){
		$tmpContent="";
		foreach($this->_Config as $tmp){
			$tmpContent.=$tmp[0]."=".$tmp[1]."\n";
		}
		file_put_contents($this->_File,$tmpContent);
	}
	
	private $_File;//The file to save
	private $_Content = "";//The content
	private $_Config = array(""=>"");//The core array
};

?>