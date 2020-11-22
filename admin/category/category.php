<?php include('../components/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1> Category </h1>
		<br />

		<?php 		
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		?>

		<br><br>

		<a href="<?php echo ADDCATEGORY ?>" class='btn-prim'>Add Category</a>

		<br /><br />

		<table class='tbl-full'>
			<tr>
				<th>ID #</th>
				<th>Title</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

			<?php 
			
				$sql = "SELECT * FROM food_category";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);

				if($count > 0) {

					while($row = mysqli_fetch_assoc($res)) {

						$sn = 1;
						$id = $row['id'];
						$title = $row['title'];
						$image_name = $row['image_name'];
						$featured = $row['featured'];
						$active = $row['active'];

						?>

			<tr>
				<td><?php echo $sn++ ?> </td>
				<td><?php echo $title ?></td>
				<td><?php 
				
					if($image_name!='') {
						?>
					<img src="<?php echo CATEGORYIMAGE ?><?php echo $image_name ?>" width="100px">
					<?php
					} else {
						echo "<div class='error'>No Image Added</div>";
					}
				
				?>
				</td>
				<td><?php echo $featured ?></td>
				<td><?php echo $active ?></td>
				<td>
					<a href="#" class="btn-update">Update Category</a>
					<a href="#" class="btn-delete">Delete Category</a>
				</td>
			</tr>

			<?php
					}
				} else {

					?>
			<tr>
				<td colspan="6">
					<div class="error">No Category Added</div>
				</td>
			</tr>
			<?php

				}

			?>

		</table>

	</div>
</div>

<?php include('../components/footer.php') ?>