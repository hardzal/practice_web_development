<?php

require_once 'functions.php';

logout();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
</head>
<body>
	<script>
		alert('Berhasil logout!');
		window.location.href = 'login.php?pesan=Anda telah logout dari sistem';
	</script>
</body>
</html>