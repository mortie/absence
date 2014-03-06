<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	session_start();

	if (file_exists("../conf.ini")) {
		$conf = parse_ini_file("../conf.ini");
		date_default_timezone_set($conf['locale']);
	} else {
		$conf = false;
	}

	$env = [];

	function requirePassword($section) {
		if (!array_key_exists("loggedin_".$section, $_SESSION) || !$_SESSION['loggedin_'.$section]) {
			die(page("login", ["section"=>$section]));
		}
	}

	function page($page, $arg=[]) {
		global $env;
		global $conf;

		$path = "pages/$page.php";
		if (file_exists($path)) {
			require $path;
		} else {
			require "pages/404.php";
		}
	}

	function template($template, $args) {
		$str = "<!--start: $template-->".PHP_EOL;
		$str .= file_get_contents("templates/$template.html");
		foreach ($args as $key=>$val) {
			$str = str_replace("{".$key."}", $val, $str);
		}
		return $str."<!--end: $template-->".PHP_EOL;
	}

	function makeMysqli($conf) {
		$mysqli = new mysqli(
			$conf['dbhost'],
			$conf['dbuser'],
			$conf['dbpass']
		);
		if ($mysqli->connect_error) {
			return false;
		} else {
			return $mysqli;
		}
	}

	function msg($str) {
		$_SESSION['msg'] = $str;
		die(header("Location: ".$_SERVER['HTTP_REFERER']));
	}

	function getMsg() {
		if (array_key_exists("msg", $_SESSION)) {
			$msg = $_SESSION['msg'];
			unset($_SESSION['msg']);
			return $msg;
		}
		return "";
	}

	if ($conf) {
		$env['mysqli'] = makeMysqli($conf);
		$env['mysqli']->select_db($conf['dbname']);
	} else {
		$env['mysql'] = new mysqli();
	}
