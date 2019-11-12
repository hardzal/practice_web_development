<?php
	require_once "functions.php";
	isLogged();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
	<div class="container">
		<h1>Login</h1>
		<?php authenticate();
			if(isset($_GET['pesan'])) :
				$pesan = strip_tags(htmlentities($_GET['pesan']));
		?>
			<p class='alert alert-danger'><?= $pesan;?></p>
		<?php
			endif;
		?>
		<form method="POST" action="">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control" required/>
			</div><br>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" required/>
			</div><br>
			<div class="form-group">
				<input type="submit" name="submit" value="Login" class="btn btn-primary"/>
			</div>
		</form>
	</div>
</body>
</html>