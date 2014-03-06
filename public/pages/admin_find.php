<?php
	requirePassword("admin");
	if (array_key_exists("dateId", $_POST)) {
		$sDateId = $env['mysqli']->real_escape_string($_POST['dateId']);
	} else {
		$sDateId = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/admin.css">
	<meta charset="utf-8">
</head>
<body>
	<form action="?p=admin_find" method="post" id="form" style="text-align: center;">
		<select name="dateId" onchange="this.form.submit()">
			<option>...</option>
<?php
	$result = $env['mysqli']->query("SELECT * FROM meeting");
	$options = "";
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			if ($sDateId == $row['id']) {
				$selected = "selected";
			} else {
				$selected = "";
			}
			$options .= template("dropdownOption", [
				"val"=>$row['id'],
				"name"=>$row['day'],
				"selected"=>$selected
			]);
		}
	}
	echo $options;
?>
		</select>
	</form>
	<br>
<?php
	if (!$sDateId) {
		die();
	}
?>
	Present:
<?php
	$presentPeople = [];
	$result = $env['mysqli']->query("SELECT * FROM meeting_has_person WHERE meeting_id='$sDateId'");
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			array_push($presentPeople, $row['person_id']);

			$personId = $row['person_id'];
			$person = $env['mysqli']->query("SELECT * FROM person WHERE id='$personId'")->fetch_assoc();

			$personRole = $env['mysqli']->query("SELECT * FROM role WHERE id='".$person['role']."'")->fetch_assoc()['name'];

			echo template("listPerson", [
				"class"=>$person['class'],
				"firstname"=>$person['firstname'],
				"lastname"=>$person['lastname'],
				"role"=>$personRole
			]);
		}
	} else {
		echo "No results";
	}
?>
	<br>
	Not present:
<?php
	$anyResults = false;
	$result = $env['mysqli']->query("SELECT * FROM person");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			if (!in_array($row['id'], $presentPeople)) {
				$anyResults = true;
				$personRole = $env['mysqli']->query("SELECT * FROM role WHERE id='".$row['role']."'")->fetch_assoc()['name'];
				echo template("listPerson", [
					"class"=>$row['class'],
					"firstname"=>$row['firstname'],
					"lastname"=>$row['lastname'],
					"role"=>$personRole
				]);
			}
		}
	}
	if (!$anyResults) {
		echo "No results";
	}
?>
</body>
</html>
