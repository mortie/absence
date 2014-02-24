<?php
	requirePassword("admin");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/admin.css">
</head>
<body>
	<form method="post" action="script.php?s=admin_updatePeople&t=admin_people">
		<span class="role">Role</span>
		<span class="class">Class</span>
		<span class="firstname">First Name</span>
		<span class="lastname">Last Name</span>
<?php

	//get roles
	$roleResult = $env['mysqli']->query("SELECT * FROM role");
	$roleRows = [];
	if ($roleResult) {
		while ($row = $roleResult->fetch_assoc()){
			array_push($roleRows, $row);
		}
	}

	//show people
	$result = $env['mysqli']->query("SELECT * FROM person ORDER BY class");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			$options = template("dropdownOption", [
				"val"=>"",
				"name"=>"...",
				"selected"=>""
			]);
			foreach($roleRows as $roleRow) {
				if ($roleRow['id'] == $row['role']) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				$options .= template("dropdownOption", [
					"val"=>"r".$roleRow['id'],
					"name"=>$roleRow['name'],
					"selected"=>$selected
				]).PHP_EOL;
			}

			echo template("person", [
				"firstname"=>$row['firstname'],
				"lastname"=>$row['lastname'],
				"id"=>$row['id'],
				"class"=>$row['class'],
				"role"=>$options,
				"append"=>"<label><input type='checkbox' name='d".$row['id']."'>Delete</label>"
			]);
		}
	}

	//new person
	$options = template("dropdownOption", [
		"val"=>"",
		"name"=>"...",
		"selected"=>""
	]);
	foreach($roleRows as $roleRow) {
		$options .= template("dropdownOption", [
			"val"=>"r".$roleRow['id'],
			"name"=>$roleRow['name'],
			"selected"=>""
		]);
	}
	echo template("person", [
		"firstname"=>"",
		"lastname"=>"",
		"id"=>"new",
		"class"=>"",
		"role"=>$options,
		"append"=>"<input type='submit' value='+'>"
	]);
?>
		<button>Submit</button>
	</form>
</body>
</html>
