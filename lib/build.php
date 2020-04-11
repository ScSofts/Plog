<?php /** @noinspection PhpParamsInspection */
/*
*Plog build helper By S·c
*/

/**
 * Class Builder
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
                while(($entry = $static->read()) != false){
					$this->copy_dir("static","publish");
				}
			}
		}
		
	}
	
	//Copy $src/* to $dest

    /**
     * @param $src {string}
     * @param $dest {$string}
     */
    private function copy_dir($src, $dest){
			if(!is_dir($dest)){
					mkdir($dest,0777);
				}
			$handle=dir($src);
			while(($entry=$handle->read()) != false) {
				if(($entry != ".") && (".." != $entry)){//Filter out . and ..
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