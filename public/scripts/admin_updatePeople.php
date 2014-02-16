<?php
	requirePassword("admin");

	$querys = [];
	$newEntry = ["empty"=>true];

	foreach ($_POST as $rPersonID=>$rVal) {
		$sPersonID = mysql_real_escape_string($rPersonID);
		$sVal = mysql_real_escape_string($rVal);

		$ID = substr($sPersonID, 1);

		if (strpos($sPersonID, "new") !== false) {
			$newEntry[$sPersonID[0]] = $sVal;
			if ($sVal != "") {
				$newEntry['empty'] = false;
			}
		} else if ($sPersonID[0] == "c") {
			$querys[$ID]['c'] = $sVal;
		} else if ($sPersonID[0] == "f") {
			$querys[$ID]['f'] = $sVal;
		} else if ($sPersonID[0] == "l") {
			$querys[$ID]['l'] = $sVal;
		} else if ($sPersonID[0] == "r") {
			$querys[$ID]['r'] = $sVal;
		} else if ($sPersonID[0] == "d") {
			$env['mysqli']->query("DELETE FROM person WHERE id='".ltrim($sPersonID, "d")."'");
		}
	}

	foreach ($querys as $key=>$val) {
		$env['mysqli']->query("UPDATE person SET class='".$val['c']."', firstname='".$val['f']."', lastname='".$val['l']."', role='".$val['r']."' WHERE id=$key");
	}

	if (!$newEntry['empty']) {
		$env['mysqli']->query("INSERT INTO person (class, firstname, lastname) VALUES ('".$newEntry['c']."', '".$newEntry['f']."', '".$newEntry['l']."')");
	}
