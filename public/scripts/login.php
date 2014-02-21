<?php
	$section = $_POST['section'];
	$pass = $_POST['pass'];

	if (md5($pass.$conf['pass_'.$section.'_salt']) === $conf['pass_'.$section.'_hash']) {
		$_SESSION['loggedin_'.$section] = true;
	} else {
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
