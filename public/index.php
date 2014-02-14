<?php
	require "inc.php";

	if ($conf) {
		if (array_key_exists("p", $_GET)) {
			$template = $_GET['p'];
		} else {
			$template = "index";
		}
	} else {
		$template = "setup";
	}

	template($template);
