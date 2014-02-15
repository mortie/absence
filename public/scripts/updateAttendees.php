<?php
	requirePassword("index");
	$sDateID = mysql_real_escape_string($_POST['dateID']);

	//Clear meeting
	$env['mysqli']->query("DELETE FROM meeting_has_person WHERE meeting_id = $sDateID");

	//Insert attendees
	foreach ($_POST as $rPersonID=>$rVal) {
		if ($rPersonID[0] == "p") {
			$sVal = mysql_real_escape_string($rVal);
			$sPersonID = ltrim(mysql_real_escape_string($rPersonID), "p");
			$env['mysqli']->query("INSERT INTO meeting_has_person (meeting_id, person_id) VALUES ('$sDateID', '$sPersonID')");
		}
	}
