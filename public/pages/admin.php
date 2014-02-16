<?php
	requirePassword('admin');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/admin.css">
	<meta charset="utf-8">
</head>  
<body>
	<span class="role">Role</span>
	<span class="class">Class</span>
	<span class="firstname">First Name</span>
	<span class="lastname">Last Name</span>
<?php page("admin_people"); ?>
	<a href=".">
		<button>Home</button>
	</a>
</body>

