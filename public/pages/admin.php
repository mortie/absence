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
	<div id="roles">
		<div class="title">Roles:</div>
		<iframe onload="autoResize(this)" id="rolesFrame" onload="reload('peopleFrame')" src="?p=admin_roles"></iframe>
	</div>
	<div id="people">
		<div class="title">People:</div>
		<iframe onload="autoResize(this)" id="peopleFrame" src="?p=admin_people"></iframe>
	</div>
	<a href=".">
		<button>Home</button>
	</a>
	<script>
		function reload(frame) {
			frame = document.getElementById(frame);
			frame.src = frame.src;
		}

		function autoResize(obj) {
			obj.height = 10;
			obj.height = obj.contentDocument.body.scrollHeight;
		}
	</script>
</body>

