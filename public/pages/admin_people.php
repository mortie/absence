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
	
	$roleResult = $env['mysqli']->query("SELECT * FROM role");
	$roleRows = [];
	while ($row = $roleResult->fetch_assoc()){
		array_push($roleRows, $row);
	};

	$result = $env['mysqli']->query("SELECT * FROM person ORDER BY class");
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

		echo template("editPerson", [
			"firstname"=>$row['firstname'],
			"lastname"=>$row['lastname'],
			"id"=>$row['id'],
			"class"=>$row['class'],
			"role"=>$options
		]);
	}

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
	echo template("newPerson", [
		"id"=>"new",
		"role"=>$options
	]);
?>
		<button>Submit</button>
	</form>
</body>
</html>
