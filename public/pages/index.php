<?php
	requirePassword("index");
?>
<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="theme/index.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
	<form method="post" action="script.php?s=updateAttendees">
		<div id="list">
<?php
	$date = date("Y-m-d");

	//Fetch meeting and such
	$result = $env['mysqli']->query("SELECT * FROM meeting WHERE day = '$date'");
	if ($result->num_rows != 0) {
		$dateID = $result->fetch_assoc()['id'];
	} else {
		$dateID = null;
	}

	//Current attendence and such
	$currAttendees = [];
	$result = $env['mysqli']->query("SELECT * FROM meeting_has_person WHERE meeting_id = $dateID");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			array_push($currAttendees, $row['person_id']);
		}
	}

	//Fecth people and such
	$result = $env['mysqli']->query("SELECT * FROM person ORDER BY class");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			if (in_array($row['id'], $currAttendees)) {
				$checked = "checked";
			} else {
				$checked = "";
			}

			echo template("personCheckbox", [
				"firstname"=>$row['firstname'],
				"lastname"=>$row['lastname'],
				"id"=>$row['id'],
				"class"=>$row['class'],
				"checked"=>$checked
			]);
		}
	}
?>
		</div>
		<input type="hidden" name="dateID" value="<?=$dateID ?>">

		<input type="submit" value="Submit">
		<a href="?p=admin">
			<input type="button" value="Admin" style="float: right">
		</a>
	</form>

	<script src="scripts/hammer.min.js"></script>
	<script>
		function getPerson(element) {
			if (element.className == "person") {
				return element;
			} else {
				return getPerson(element.parentNode);
			}
		}

		function toggle(e) {
			checkbox = getPerson(e.target).children[0];
			checkbox.checked = !checkbox.checked;
		}

		var people = document.getElementsByClassName("person");
		for (var i=1; i<people.length; ++i) {
			Hammer(people[i]).on("tap", toggle)

			people[i].addEventListener("click", function(e) {
				e.preventDefault();
				console.log("stopped");
			});
		}
	</script>
</body>
