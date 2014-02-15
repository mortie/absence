<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form method="post" action="script.php?s=login&t=<?=$arg['section'] ?>">
		<input type="hidden" name="section" value="<?=$arg['section'] ?>">
		Password: <input name="pass" type="password">
		<button>Log in</button>
	</form>
</body>
</html>
