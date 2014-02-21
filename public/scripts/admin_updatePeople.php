<?php
	requirePassword("admin");

	$queries = [];
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
			$queries[$ID]['c'] = $sVal;
		} else if ($sPersonID[0] == "f") {
			$queries[$ID]['f'] = $sVal;
		} else if ($sPersonID[0] == "l") {
			$queries[$ID]['l'] = $sVal;
		} else if ($sPersonID[0] == "r") {
			$queries[$ID]['r'] = substr($sVal, 1);
		} else if ($sPersonID[0] == "d") {
			$env['mysqli']->query("DELETE FROM meeting_has_person WHERE person_id='$ID'");
			$env['mysqli']->query("DELETE FROM person WHERE id='$ID'");
		}
	}

	foreach ($queries as $key=>$val) {
		$env['mysqli']->query("UPDATE person SET class='".$val['c']."', firstname='".$val['f']."', lastname='".$val['l']."', role='".$val['r']."' WHERE id=$key");
	}

	if (!$newEntry['empty']) {
		$env['mysqli']->query("INSERT INTO person (class, firstname, lastname) VALUES ('".$newEntry['c']."', '".$newEntry['f']."', '".$newEntry['l']."')");
	}
