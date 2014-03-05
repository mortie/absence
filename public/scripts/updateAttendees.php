<?php
	requirePassword("index");
	$sDateID = $env['mysqli']->real_escape_string($_POST['dateID']);
	$date = date("Y-m-d");

	//Clear meeting
	$env['mysqli']->query("DELETE FROM meeting_has_person WHERE meeting_id = $sDateID");

	//Create attendees array
	$attendees = [];
	foreach ($_POST as $rPersonID=>$rVal) {
		if ($rPersonID[0] == "p") {
			$sVal = $env['mysqli']->real_escape_string($rVal);
			$sPersonID = ltrim($env['mysqli']->real_escape_string($rPersonID), "p");
			$attendees[$sPersonID] = $sVal;
		}
	}

	if ($attendees != []) { //Insert attendees into meeting table (and create table entry if needed)
		if (!$sDateID) {
			$env['mysqli']->query("INSERT INTO meeting (day) VALUES ('$date')");
			$sDateID = $env['mysqli']->insert_id;
		}
		foreach ($attendees as $personID=>$val) {
			$env['mysqli']->query("INSERT INTO meeting_has_person (meeting_id, person_id) VALUES ('$sDateID', '$personID')");
		}
	} else { //Remove table entry if no attendees
		$env['mysqli']->query("DELETE FROM meeting WHERE id='$sDateID'");
	}
