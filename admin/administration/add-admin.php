<?php include('../components/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Create Admin</h1>

		<br /><br />

		<?php if(isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		} ?>

		<form action="" method="POST">

			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td><input type="text" name="full_name" placeholder="Full Name"> </td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="User Name"> </td>
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" placeholder="Create password"> </td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Create" class="btn-create">
					</td>
				</tr>
			</table>

		</form>
	</div>
</div>

<?php include('../components/footer.php') ?>

<?php

if(isset($_POST['submit'])) {
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "INSERT INTO food_admin SET
		full_name='$full_name',		
		username='$username',
		password='$password'
	";

	$res = mysqli_query($conn, $sql) or die(mysqli_error());

	if($res == TRUE) {
		$_SESSION['add'] = "Admin Created Successfully!";
		header("location:".ADMINREDIRECT);
	} else {
		$_SESSION['add'] = "Something failed, try again...";
	}
} 

?>