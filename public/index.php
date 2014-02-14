<?php
	require "inc.php";

	if ($conf) {
		if (array_key_exists("p", $_GET)) {
			$page = $_GET['p'];
		} else {
			$page = "index";
		}
	} else {
		$page = "setup";
	}

	page($page);
