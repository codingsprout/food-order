<?php include('../config/config.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login System</title>
	<link rel="stylesheet" href="../../css/login.css">
</head>

<body>

	<div class="login">
		<h1 class="txt-c">Login</h1>
		<br><br>

		<?php 
			if(isset($_SESSION['login'])) {
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}
			if(isset($_SESSION['no-auth'])) {
				echo $_SESSION['no-auth'];
				unset($_SESSION['no-auth']);
			}
		?>

		<br><br>

		<form action="" method="POST" class="txt-c">
			Username: <br>
			<input type="text" name="username" placeholder="Enter Username"> <br><br>
			Password: <br>
			<input type="password" name="password" placeholder="Enter Password"> <br><br>

			<input type="submit" name="submit" value="Login" class="btn-prim"><br><br>
		</form>

		<p class="txt-c">Created By - <a href="#">Cero</a></p>
	</div>
</body>

</html>

<?php 
	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM food_admin WHERE username='$username' AND password='$password'";

		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);

		if($count == 1) {
			$_SESSION['login'] = "<div class='success txt-c'>Login Successful</div>";
			$_SESSION['user'] = $username;
			header('location:'.HOMEPAGE);
		} else {
			$_SESSION['login'] = "<div class='error txt-c'>Login Error, Please try again!</div>";
		}
	}
?>