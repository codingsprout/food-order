<?php include('../components/menu.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1> Food </h1>

		<br />
		<a href="<?php echo ADDFOOD?>" class='btn-prim'>Add Food</a>

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
			if(isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			if(isset($_SESSION['unauthorized'])) {
				echo $_SESSION['unauthorized'];
				unset($_SESSION['unauthorized']);
			}
			if(isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
		?>

		<table class='tbl-full'>
			<tr>
				<th>ID #</th>
				<th>Title</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

			<?php 
			
				$sql = "SELECT * FROM food_type";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				$sn = 1;

				if($count > 0) {

					while($row = mysqli_fetch_assoc($res)) {

						$id = $row['id'];
						$title = $row['title'];
						$price = $row['price'];
						$image_name = $row['image_name'];
						$featured = $row['featured'];
						$active = $row['active'];

						?><tr>
				<td><?php echo $sn++ ?> </td>
				<td><?php echo $title ?></td>
				<td><?php echo $price ?></td>
				<td><?php if($image_name == '') {
					echo "<div class='error'>Image was not added previously</div>";
				} else {
					?><img src="<?php echo FOODIMAGE ?><?php echo $image_name?>" width="100px"><?php
					
				}?>
				</td>
				<td><?php echo $featured ?></td>
				<td><?php echo $active ?></td>
				<td>
					<a href="<?php echo UPDATEFOOD?>?id=<?php echo $id ?>" class="btn-update">Update Food</a>
					<a href="<?php echo DELETEFOOD?>?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>"
						class="btn-delete">Delete Food</a>
				</td>
			</tr><?php
					}
				} else {
					echo "<tr> <td colspan='7' class='error'>Food has not been added</td></tr>";
				}
			
			?>
		</table>
	</div>
</div>

<?php include('../components/footer.php') ?>