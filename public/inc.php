<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	if (file_exists("../conf.ini")) {
		$conf = parse_ini_file("../conf.ini");
	} else {
		$conf = false;
	}

	$env = [];

	function page($page) {
		global $env;
		global $conf;
		require "pages/$page.php";
	}

	function template($template, $args) {
		$str = file_get_contents("templates/$template.html");
		foreach ($args as $key=>$val) {
			$str = str_replace("{".$key."}", $val, $str);
		}
		echo "<!--Start of $template.html-->".PHP_EOL;
		echo $str;
		echo "<!--End of $template.html-->".PHP_EOL;
	}

	function make_mysqli($conf) {
		return new mysqli(
			$conf['dbhost'],
			$conf['dbuser'],
			$conf['dbpass']
		);
	}

	if ($conf) {
		$env['mysqli'] = make_mysqli($conf);
		$env['mysqli']->select_db($conf['dbname']);
	} else {
		$env['mysql'] = new mysqli();
	}
