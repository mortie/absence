<?php
	require "inc.php";

	$sPath = "scripts/".$_GET['s'].".php";
	require $sPath;
	if (array_key_exists("t", $_GET)) {
		header("Location: .?p=".$_GET['t']);
	} else {
		header("Location: .");
	}
