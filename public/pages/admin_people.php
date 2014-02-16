<?php
	requirePassword("admin");
?>
<form method="post" action="script.php?s=admin_updatePeople&t=admin">
<?php
	$result = $env['mysqli']->query("SELECT * FROM person ORDER BY class");
	while ($row = $result->fetch_assoc()) {
		template("editPerson", [
			"firstname"=>$row['firstname'],
			"lastname"=>$row['lastname'],
			"id"=>$row['id'],
			"class"=>$row['class'],
			"role"=>$row['role']
		]);
	}

	template("newPerson", [
		"id"=>"new"
	]);
?>
	<button>Submit</button>
</form>
