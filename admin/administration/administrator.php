<?php include('../components/menu.php') ?>


<div class="main-content">
	<div class='wrapper'>
		<h1>Admin</h1>

		<br />
		<a href="add-admin.php" class='btn-prim'>Add New Admin</a>

		<br /><br />


		<?php 
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			if(isset($_SESSION['delete'])) {
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}
			if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
			if(isset($_SESSION['pw-update-success'])) {
				echo $_SESSION['pw-update-success'];
				unset($_SESSION['pw-update-success']);
			}
		?>

		<table class='tbl-full m1'>
			<tr>
				<th>ID #</th>
				<th>Full name</th>
				<th>Username</th>
				<th>Actions</th>
			</tr>

			<?php

				$sql = "SELECT * FROM food_admin";
				$res = mysqli_query($conn, $sql);
				$idnum = 1;

				if($res == TRUE) {
					$count = mysqli_num_rows($res);
					if($count > 0) {
						while($rows = mysqli_fetch_assoc($res)) {
							$id = $rows['id'];
							$full_name = $rows['full_name'];
							$username = $rows['username'];

			?>

			<tr>
				<td><?php echo $idnum++ ?> </td>
				<td><?php echo $full_name ?></td>
				<td><?php echo $username ?></td>
				<td>
					<a href="<?php echo PASSWORDADMIN ?>?id=<?php echo $id ?>" class="btn-password">Change Password</a>
					<a href="<?php echo UPDATEADMIN ?>?id=<?php echo $id ?>" class="btn-update">Update Admin</a>
					<a href="<?php echo DELETEADMIN ?>?id=<?php echo $id ?>" class="btn-delete">Delete Admin</a>
				</td>
			</tr>

			<?php
						}
					}
				} else {
					echo "Something went horribly wrong!";
				}

			?>

		</table>

	</div>
</div>

<?php include('../components/footer.php') ?>