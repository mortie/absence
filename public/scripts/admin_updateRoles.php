<?php
	requirePassword("admin");

	$queries = [];
	$newEntry = ["empty"=>true];

	foreach ($_POST as $rRoleID=>$rVal) {
		$sRoleID = mysql_real_escape_string($rRoleID);
		$sVal = mysql_real_escape_string($rVal);

		$ID = substr($sRoleID, 1);

		if (strpos($sRoleID, "new") !== false) {
			$newEntry[$sRoleID[0]] = $sVal;
			if ($sVal != "") {
				$newEntry['empty'] = false;
			}
		} else if ($sRoleID[0] == "n") {
			$queries[$ID]['n'] = $sVal;
		} else if ($sRoleID[0] == "d") {
			$env['mysqli']->query("DELETE FROM role WHERE id='$ID'");
		}
	}

	foreach ($queries as $key=>$val) {
		$env['mysqli']->query("UPDATE role SET name='".$val['n']."' WHERE id='$key'");
	}

	if (!$newEntry['empty']) {
		$env['mysqli']->query("INSERT INTO role (name) VALUES ('".$newEntry['n']."')");
	}
