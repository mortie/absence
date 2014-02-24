<?php
	if (!empty($conf)) {
		requirePassword("admin");
	}

	function randString($length) {
		return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0, 1) . substr(str_shuffle("aBcEeFgHiJkLmNoPqRstUvWxYz0123456789"),0, $length-1);
	}

	$conf['dbname'] = $_POST['dbname'];
	$conf['dbhost'] = $_POST['dbhost'];
	$conf['dbuser'] = $_POST['dbuser'];
	$conf['dbpass'] = $_POST['dbpass'];
	$conf['locale'] = $_POST['locale'];

	$conf['pass_index_salt'] = randString(32);
	$conf['pass_index_hash'] = md5($_POST['indexpass'].$conf['pass_index_salt']);
	$conf['pass_admin_salt'] = randString(32);
	$conf['pass_admin_hash'] = md5($_POST['adminpass'].$conf['pass_admin_salt']);

	$env['mysqli'] = makeMysqli($conf);
	if (!$env['mysqli']) {
		msg("A MySQL connection error occurred. Make sure you used the correct username/password, and that the MySQL server is running.");
	}

	$rQuery = file_get_contents("setup/sql.txt");
	$fQuery = str_replace("{dbname}", $conf['dbname'], $rQuery);

	$env['mysqli']->multi_query($fQuery);
	if ($env['mysqli']->error != "") {
		msg("An error occurred: ".$env['mysqli']->error);
	}

	$confStr = "";
	foreach ($conf as $key=>$val) {
		$confStr .= $key." = ".$val.PHP_EOL;
	}
	file_put_contents("../conf.ini", $confStr);
