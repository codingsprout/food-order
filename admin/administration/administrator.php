<?php include('../components/menu.php') ?>


<div class="main-content">
	<div class='wrapper'>
		<h1>Admin</h1>

		<br />
		<a href="add-admin.php" class='btn-prim'>Manage Admin</a>

		<br /><br />


		<?php 
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
		} 
		?>

		<table class='tbl-full'>
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
					<a href="#" class="btn-update">Update</a>
					<a href="#" class="btn-delete">Delete</a>
				</td>
			</tr>

			<?php
						}
					}
				}

			?>

		</table>

	</div>
</div>

<?php include('../components/footer.php') ?>