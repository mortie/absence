<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
	<form method="post" action="script.php?s=login&t=<?=$arg['section'] ?>">
		<input type="hidden" name="section" value="<?=$arg['section'] ?>">
		Password: <input name="pass" type="password">
		<button>Log in</button>
	</form>
</body>
</html>
