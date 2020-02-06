<?php
/*
^Plog Project Creator By S·c
*/

class Creator{
	public function __construct(){
		echo("Creating...");
		$this->make_dir();
	}
	public function __destruct(){
		echo("Create finished");
	}
	
	//To make necessay directories
	private function make_dir(){
		mkdir("static");
		mkdir("publish");
		mkdir("articles");
		mkdir("templates");
		echo $argv[0];
	}
	//Copy $src/* to $dest
	private function copy_dir($src, $dest){
			if(!is_dir($dest)){
					mkdir($dest,0777);
				}
			$handle=dir($src);
			while($entry=$handle->read()) {
				if(($entry != ".") && ($entry != "..")){//Filter out . and .. 
					if(is_dir($src."/".$entry)){
							$this->copy_dir($src."/".$entry,$dest."/".$entry);
						}
					else{
						copy($src."/".$entry,$dest."/".$entry);
					}
				}
			}
		}
};
?>