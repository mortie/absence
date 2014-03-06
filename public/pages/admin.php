<?php
	requirePassword('admin');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="theme/admin.css">
	<meta charset="utf-8">
</head>
<body style="width: 580px;">
	<div id="nav">
		<a href="?p=index"><button>Home</button></a>
		<button id="people" onclick="go('#people')">People</button>
		<button id="roles" onclick="go('#roles')">Roles</button>
		<button id="find" onclick="go('#find')">Find</button>
	</div>
	<iframe id="frame" onload="updateSize(this)"></iframe>

	<script>
		var prevButton;
		var frame = document.getElementById("frame");
		function go(hash) {
			hash = hash.substring(1);

			button = document.getElementById(hash);
			if (prevButton != undefined) {
				prevButton.className = "";
			}
			button.className = "current";
			prevButton = button;
			frame.src = "?p=admin_"+hash;
			document.location.hash = hash;
		}

		function updateSize(element) {
			element.style.height = (element.contentWindow.document.body.scrollHeight)+"px";
		}

		if (document.location.hash) {
			go(document.location.hash);
		} else {
			go("#people");
		}
	</script>

</body>

