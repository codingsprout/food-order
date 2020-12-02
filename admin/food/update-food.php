<?php include('../components/menu.php');?>

<?php 
	if(isset($_GET['id'])) {

		$id = $_GET['id'];
		$sql2 = "SELECT * FROM food_type WHERE id=$id";
		$res2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_assoc($res2);

		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['image_name'];
		$current_category = $row2['category_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];

	} else {
		$_SESSION['error'] = "<div class='error'>Food either could not be found, or corrupt file or something!</div>";
		header('location:'.FOODREDIRECT);
	}
?>

<div class='main-content'>
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>

		<?php 		
			if(isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}		
			if(isset($_SESSION['remove-failure'])) {
				echo $_SESSION['remove-failure'];
				unset($_SESSION['remove-failure']);
			}		
			if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}		
		?>

		<form action="" method='POST' enctype='multipart/form-data'>

			<table class="tbl-30">

				<tr>
					<td>Title: </td>
					<td><input type="text" name='title' placeholder="Food Title" value="<?php echo $title?>"></td>
				</tr>

				<tr>
					<td>Description: </td>
					<td><textarea name="description" cols="30" rows="5" value="<?php echo $description?>"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td><input type="number" name='price' value="<?php echo $price?>"></td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php 
						
							if($current_image == '') {
								echo "<div class='error'>No image uploaded/found with food item</div>";
							} else {
								?><img src="<?php echo FOODIMAGE?><?php echo $current_image?>" alt="<?php echo $title?>" width="150px"><?php
							}
						
						?>
					</td>
				</tr>

				<tr>
					<td>Select New Image: </td>
					<td><input type="file" name='image'></td>
				</tr>

				<tr>
					<td>Category: </td>
					<td><select name="category">

							<?php 
						
							$sql = "SELECT * FROM food_category WHERE active='Yes'";
							$res = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($res);

							if($count > 0) {

								while($row = mysqli_fetch_assoc($res)) {

									$category_title = $row['title'];
									$category_id = $row['id'];
									?><option <?php if($current_category == $category_id) {echo 'selected';}?> value="<?php echo $category_id ?>">
								<?php echo $category_title ?></option><?php
								}

							} else {
								echo "<option value='0'>Category Not Available</option>";
							}
						
						?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured == 'Yes') {echo 'checked';} ?> type="radio" name='featured'
							value="Yes">Yes
						<input <?php if($featured == 'No') {echo 'checked';} ?> type="radio" name='featured'
							value="No">No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active == 'Yes') {echo 'checked';} ?> type="radio" name='active'
							value="Yes">Yes
						<input <?php if($active == 'No') {echo 'checked';} ?> type="radio" name='active' value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id?>">
						<input type="hidden" name="current_image" value="<?php echo $current_image?>">
						<input type="submit" name="submit" value="Update" class="btn-create">
					</td>
				</tr>

			</table>
		</form>

		<?php

			if(isset($_POST['submit'])) {

				$id = $_POST['id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$current_image = $_POST['current_image'];
				$category = $_POST['category'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				if(isset($_FILES['image']['name'])) {
					
					$image_name = $_FILES['image']['name'];

					if($image_name !='') {

						$ext = end(explode('.', $image_name));
						$image_name = "Food_Image".rand(0000,9999).'.'.$ext;
						$src_path = $_FILES['image']['tmp_name'];
						$dest_path = '../images/'.$image_name;
						$upload = move_uploaded_file($src_path, $dest_path);

						if($upload == false) {
							$_SESSION['upload'] = "<div class='error'>Something went horribly wrong, did not update food!</div>";
							die();
						}

						if($current_image != '') {

							$remove_path = '../images/'.$current_image;
							$remove = unlink($remove_path);

							if($remove == false) {
								$_SESSION['remove-failure'] = "<div class='error'>Failed to remove current image</div>";
								die();
							}
						}
					}

				} else {
					$image_name = $current_image;
				}

				$sql3 = "UPDATE food_type SET
					title = '$title',
					description = '$description',
					price = '$price',
					image_name = '$image_name',
					category_id = '$category',
					featured = '$featured',
					active = '$active',
					WHERE id = $id
				";

				$res3 = mysqli_query($conn, $sql3);

				if($res3 == true) {
					$_SESSION['update'] = "<div class='success'>Food Updated Sucessfully!</div>";
					header('location:'.FOODREDIRECT);
				} else {
					$_SESSION['update'] = "<div class='error'>Oops, something went wrong! Check everything again</div>";
					die();
				}
			}
		?>
	</div>
</div>

<?php include('../components/footer.php');?>