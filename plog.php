<?php
	$version="1.0.0";//The Version Code
	
	//Check to make sure it's running in the CLI mode
	if(!isset($argc)||$argc<2){
		
		echo("Wrong useage!\n");
		echo("Plog can`t run in the browser!\n");
		echo("Use \`php plog.php\` -h or \`php plog.php\` --help for help\n");
		echo("Plog V{$version} By Sc\n");
		die("GitHub https://github.com/ScSofts/Plog.git\n");
		exit(-1);
	}

	//Analyze the parameters
	switch($argv[1]){
		case '-h':
		case '--help':
			echo("Plog V{$version} By Sc\n");
			echo("GitHub https://github.com/ScSofts/Plog.git\n");
			echo("Usage php plog.php <Command> [Options]\n");
			echo("Commands: \n");
			echo(" build      => Generate or update static files\n");
			echo(" preview    => Local preview in the browser\n");
			echo(" create     => Create a project\n");
			echo(" publish    => Publish in the github or other platforms\n");
			echo("Options: \n");
			echo(" For preview: \n");
			echo("  -p <Port>  => The server port\n");
			echo("  -a         => Auto open browser(require Windows)\n");
			echo(" For create: \n");
			echo("  -m         => Create a template project\n");
			echo(" For build: \n");
			echo("  -c         => Compress for less size\n");
			break;
		case 'build':
		case "Build":
			require("lib/build.php");
			$builder = new Builder();
			$builder->build();
			exit(0);
			break;
		case 'create':
		case "Create":
			require("lib/create.php");
			$crateor = new Creator($argc,$argv);
			exit(0);
			break;
		default:
			echo("Unknown command {$argv[1]}!\n");
			echo("Use php plog.php -h or php plog.php --help for help\n");
			echo("Plog V{$version} By Sc\n");
			die("GitHub https://github.com/ScSofts/Plog.git\n");
	}
?>