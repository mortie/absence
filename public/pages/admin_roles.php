<?php
	requirePassword("admin");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/admin.css">
</head>
<body>
	<form method="post" action="script.php?s=admin_updateRoles&t=admin_roles">
<?php
	$result = $env['mysqli']->query("SELECT * FROM role");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			echo template("editRole", [
				"id"=>$row['id'],
				"name"=>$row['name']
			]);
		}
	}
	echo template("newRole", [
		"id"=>"new"
	]);

?>
		<button>Submit</button>
	</form>
</body>
</html>
