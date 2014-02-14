<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/setup.css">
</head>
<body>
	<form method="post" action="script.php?s=setup">
		<div class="table">
			<div class="key">
				Database Name:
			</div>
			<div class="val">
				<input type="text" name="dbname" value="abstinence">
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
				<input type="text" name="dbpass">
			</div>

			<div class="key"></div>
			<div class="val">
				<input type="submit" value="Submit">
			</div>
		</div>
	</form>
</body>
</html>
