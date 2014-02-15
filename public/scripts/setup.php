<?php
	if ($conf)
		die("Already set up. Edit the conf.ini file instead.");

	$conf['dbname'] = $_POST['dbname'];
	$conf['dbhost'] = $_POST['dbhost'];
	$conf['dbuser'] = $_POST['dbuser'];
	$conf['dbpass'] = $_POST['dbpass'];
	$conf['locale'] = $_POST['locale'];

	$rQuery = file_get_contents("setup/sql.txt");
	$fQuery = str_replace("{dbname}", $conf['dbname'], $rQuery);

	$env['mysqli'] = make_mysqli($conf);
	$env['mysqli']->multi_query($fQuery);

	$confStr = "";
	foreach ($conf as $key=>$val) {
		$confStr .= $key." = ".$val.PHP_EOL;
	}
	file_put_contents("../conf.ini", $confStr);
