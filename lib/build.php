<?php
/*
*Plog build helper By S·c
*/
class Builder{
	
	public function __construct(){
		echo("Building...\n");
	}
	
	public function __destruct(){
		echo("Build finished!\n");
	}
	
	//Do build work
	public function build(){
		echo("Copying static files...\n");
		//Check directory
		if(!is_dir("static")){
			echo("The directory static not found!\n");
			die("Build failed!\n");
		}else{
			if(!is_dir("publish")){
			echo("The directory publish not found!\n");
			die("Build failed!\n");				
			}else{
				$static = dir("static");
				while($entry = $static->read() != false){
					$this->copy_dir("static","publish");
				}
			}
		}
		
	}
	
	//Copy $source/* to $destination
	private function copy_dir($source, $destination){
			if(!is_dir($destination)){
					mkdir($destination,0777);
				}
			$handle=dir($source);
			while($entry=$handle->read()) {
				if(($entry!=".")&&($entry!="..")){
					if(is_dir($source."/".$entry)){
							$this->copy_dir($source."/".$entry,$destination."/".$entry,$child);
						}
					else{
						copy($source."/".$entry,$destination."/".$entry);
					}
				}
			}
		}
};
?>