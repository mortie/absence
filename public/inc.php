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

	function template($template) {
		global $env;
		global $conf;
		require "templates/$template.php";
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
