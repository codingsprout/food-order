<?php include('../components/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Password Edit</h1>
		<br><br>

		<?php if(isset($_GET['id'])) { $id = $_GET['id']; } ?>

		<form action="" method="POST">

			<table class="tbl-30">
				<tr>
					<td>Current Password: </td>
					<td><input type="password" name="current_password" placeholder="Current Password"></td>
				</tr>

				<tr>
					<td>New Password: </td>
					<td><input type="password" name="new_password" placeholder="New Password"></td>
				</tr>

				<tr>
					<td>Confirm Password: </td>
					<td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="submit" name="submit" value="Submit" class="btn-create">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php

	if(isset($_POST['submit'])) {

		$id = $_POST['id'];
		$current_password = md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);

		$sql = "SELECT * FROM food_admin WHERE id = $id AND password = '$current_password'";
		$res = mysqli_query($conn, $sql);

		if($res == TRUE) {

			$count = mysqli_num_rows($res);
			if($count == 1) {
				
				if($new_password == $confirm_password) {

					$pwsql = "UPDATE food_admin SET
						password = '$new_password'
						WHERE id = $id
					";

					$pwres = mysqli_query($conn, $pwsql);

					if($pwres == TRUE) {
						$_SESSION['pw-update-success'] = "<div class='success'>Password updated successfully!</div>";
						header('location:'.ADMINREDIRECT);
					} else {
						$_SESSION['coding-error'] = "<div class='error'>Check the code! Something is wrong!</div>";
						echo $_SESSION['coding-error'];
					}

				} else {
					$_SESSION['password-not-match'] = "<div class='error'>Passwords do not match!</div>";
					echo $_SESSION['password-not-match'];
				}
			} else {
				$_SESSION['wrong-password'] = "<div class='error'>Wrong password!</div>";
				echo $_SESSION['wrong-password'];
			}

		} else {

		}
	}
?>

<?php include('../components/footer.php') ?>