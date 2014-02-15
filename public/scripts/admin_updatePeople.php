<?php
	$newEntry = ["empty"=>true];

	foreach ($_POST as $rPersonID=>$rVal) {
		$sPersonID = mysql_real_escape_string($rPersonID);
		$sVal = mysql_real_escape_string($rVal);

		if (strpos($sPersonID, "new") !== false) {
			$newEntry[$sPersonID[0]] = $sVal;
			if ($sVal != "") {
				$newEntry['empty'] = false;
			}
		} else if ($sPersonID[0] == "c") {
			$env['mysqli']->query("UPDATE person SET class='$sVal' WHERE id='".ltrim($sPersonID, "c")."'");
		} else if ($sPersonID[0] == "f") {
			$env['mysqli']->query("UPDATE person SET firstname='$sVal' WHERE id='".ltrim($sPersonID, "f")."'");
		} else if ($sPersonID[0] == "l") {
			$env['mysqli']->query("UPDATE person SET lastname='$sVal' WHERE id='".ltrim($sPersonID, "l")."'");
		} else if ($sPersonID[0] == "d") {
			$env['mysqli']->query("DELETE FROM person WHERE id='".ltrim($sPersonID, "d")."'");
		}
	}

	if (!$newEntry['empty']) {
		$env['mysqli']->query("INSERT INTO person (class, firstname, lastname) VALUES ('".$newEntry['c']."', '".$newEntry['f']."', '".$newEntry['l']."')");
	}
