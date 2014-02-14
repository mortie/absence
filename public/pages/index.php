<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="theme/index.css">
</head>
<body>
	<form method="post" action="script.php?s=updateAbs">
<?php
	$result = $env['mysqli']->query("SELECT * FROM people ORDER BY class");

	while ($row = $result->fetch_assoc()) {
		template("person", [
			"firstname"=>$row['firstname'],
			"lastname"=>$row['lastname'],
			"id"=>$row['id'],
			"class"=>$row['class']
		]);
	}
?>
	<input type="submit" value="Submit">
	</form>
</body>
