<?php
	requirePassword("admin");
	if (array_key_exists("date", $_POST)) {
		$sDate = $env['mysqli']->real_escape_string($_POST['date']);
	} else {
		$sDate = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/find.css">
	<meta charset="utf-8">
</head>
<body>
	<form action="?p=admin_find" method="post" id="form">
		Date: <input name="date" type="text" id="datepicker" onchange="$('#form').submit()" value="<?=$sDate ?>">
	</form>

<?php
	$result = $env['mysqli']->query("SELECT * FROM meeting WHERE day='$sDate'");

	$dateId = $result->fetch_assoc()['id'];
	$result = $env['mysqli']->query("SELECT * FROM meeting_has_person WHERE person_id='$dateId'");
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			$personId = $row['person_id'];
			$person = $env['mysqli']->query("SELECT * FROM person WHERE id='$personId'")->fetch_assoc();

			$personClass = $env['mysqli']->query("SELECT * FROM role WHERE id='".$person['role']."'")->fetch_assoc()['name'];

			echo template("listPerson", [
				"class"=>$person['class'],
				"firstname"=>$person['firstname'],
				"lastname"=>$person['lastname'],
				"role"=>$personClass
			]);
		}
	}
?>

	<a href="?p=admin">
		<input type="button" value="Back">
	</a>

	<script src="//ajax.googleapis.com/ajax/libFebruarys/jquery/1.11.0/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.9.1.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script>
		$(function() {
			$("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
		});
	</script>
</body>
</html>
