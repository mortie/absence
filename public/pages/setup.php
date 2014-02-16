<?php
	if (!empty($conf)) {
		requirePassword("admin");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/setup.css">
	<meta charset="utf-8">
</head>
<body>
	<form method="post" action="script.php?s=setup">
		<div class="table">
			<div class="key">
				Database Name:
			</div>
			<div class="val">
				<input type="text" name="dbname" value="absence">
			</div>

			<div class="key">
				Database Host:
			</div>
			<div class="val">
				<input type="text" name="dbhost" value="localhost">
			</div>

			<div class="key">
				Database User:
			</div>
			<div class="val">
				<input type="text" name="dbuser" value="root">
			</div>

			<div class="key">
				Database Password:
			</div>
			<div class="val">
				<input type="password" name="dbpass">
			</div>

			<div class="key">
				Time Zone:
			</div>
			<div class="val">
				<input type="text" name="locale" value="Europe/Oslo">
			</div>

			<div class="key">
				Password:
			</div>
			<div class="val">
				<input type="password" name="indexpass">
			</div>

			<div class="key">
				Admin Password:
			</div>
			<div class="val">
				<input type="password" name="adminpass">
			</div>

			<div class="key"></div>
			<div class="val">
				<input type="submit" value="Submit">
			</div>
		</div>
	</form>
</body>
</html>
