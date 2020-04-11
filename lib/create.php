<?php /** @noinspection ALL */

/*
^Plog Project Creator By S·c
*/

class Creator{
	public function __construct($argc,$argv){
		if($argc < 3){
			die("The create command should have a name (directory) param!\n");
		}
		$this->work_dir = $argv[2];
		$this->argc = $argc;
		$this->argv = $argv;
		echo("Creating...\n");
		$this->make_dir();
		echo("Copying files...\n");
        $this->copy_files();
        echo("Configuring...\n");
        $this->configure();
	}
	public function __destruct(){
		echo("Create finished");
	}
	
	//To make necessay directories
	private function make_dir(){
		if(!is_dir($this->work_dir))
			mkdir($this->work_dir);
		mkdir($this->work_dir."/static");
		mkdir($this->work_dir."/publish");
		mkdir($this->work_dir."/articles");
		mkdir($this->work_dir."/template");
		echo("Directories done!\n");

	}
	private function copy_files(){
		echo("Choose a template:\n");
		$this->templates = $this->list_dir(__DIR__."/../template");
		foreach($this->templates as $i=>$value)
		    echo "{$i} => {$value}\n";
        echo("Select(Number)>");
		$instream = fopen("php://stdin","r+");
		$select = fgets($instream);
		fclose($instream);
		$template = $this->templates[floor($select)];
		$this->copy_dir(__DIR__."/../template/".$template,
            $this->argv[2]."/template");
		echo("\n");
	}

	private function configure(){
	    $dir = $this->argv[2];
	    $name = "/package.pconf";
	    require("config.php");
	    $cfg = new Config($dir.$name);
	    $cfg->set("NAME","Your Blog's Name");
	    $cfg->save();
    }

	//--------------------------------------------------------
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
	private function list_dir($dir_name){
	    //die($dir_name);
	    $hdir = dir($dir_name);
	    $arr_list = array();
	    while(FALSE != ($entry = $hdir->read())){
	        if($entry == "." || $entry == "..")
	            continue;
	        array_push($arr_list,$entry);
	        //echo($entry);
        }
        $hdir->close();
        return $arr_list;
    }
	private $work_dir = "";
	private $templates = array();
	private $argv = array(),$argc = 0;
};
?>