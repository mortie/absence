<?php
	require "inc.php";

	if ($conf)
		$template = $_GET['p'];
		if (!$template) $template = "index";
	else
		$template = "setup";
