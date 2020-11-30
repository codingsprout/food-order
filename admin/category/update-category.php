<?php include('../components/menu.php')?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>
		<br><br>

		<?php 
		
			if(isset($_GET['id'])) {

				$id = $_GET['id'];
				$sql = "SELECT * FROM food_category WHERE id=$id";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);

				if($count == 1) {

					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];

				} else {
					$_SESSION['no-category-found'] = "<div class='error'>Current category was not found in database!</div>";
					header('location:'.CATEGORYREDIRECT);
				}

			} else {
				header('location:'.CATEGORYREDIRECT);
			}

		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">

				<tr>
					<td>Title:</td>
					<td><input type="text" name="title" value="<?php echo $title ?>"></td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td><?php 
					
						if($current_image != "") {
							?><img src="<?php echo CATEGORYIMAGE?><?php echo $current_image ?>" width="150px"><?php
						} else {
							echo "<div class='error'>No image was added previously</div>";
						}

					?></td>
				</tr>

				<tr>
					<td>New Image: </td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured"
							value="Yes">Yes
						<input <?php if($featured == "No") {echo "checked";} ?> type="radio" name="featured"
							value="No">No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active"
							value="Yes">Yes
						<input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="current_image" value="<?php echo $current_image ?>">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<input type="submit" name="submit" value="Update" class="btn-create">
					</td>
				</tr>

			</table>
		</form>

		<?php 

			if(isset($_POST['submit'])) {

				$id = $_POST['id'];
				$title = $_POST['title'];
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				if(isset($_FILES['image']['name'])) {

					$image_name = $_FILES['image']['name'];

					if($image_name != "") {
						$ext = end(explode('.', $image_name));
						$image_name = "Food_Image".rand(000,999).'.'.$ext;
						
						$sourcePath = $_FILES['image']['tmp_name'];
						$destinationPath = '../images/'.$image_name;
						$uploadImage = move_uploaded_file($sourcePath, $destinationPath);
						
						if($uploadImage == false) {
							$_SESSION['uploadImage'] = "<div class='error'>Something failed, try again...</div>";
							die();
						}

						if($current_image != "") {
							
							$remove_path = '../images/'.$current_image;
							$remove = unlink($remove_path);
	
							if($remove == false) {
								$_SESSION['remove-fail'] = "<div class='error>Failed to remove current image</div>";
								die();
							}
						}

					} else {
						$image_name = $current_image;
					}
				} else {
					$image_name = $current_image;
				}

				$newsql = "UPDATE food_category SET
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
					WHERE id=$id
				";

				$newres = mysqli_query($conn, $newsql);

				if($newres == true) {
					$_SESSION['update'] = "<div class='success'>Category Update Successful!</div>";
					header('location:'.CATEGORYREDIRECT);
				} else {
					$_SESSION['update'] = "<div class='error'>Something went wrong!</div>";
				}

			}
		
		?>

	</div>
</div>

<?php include('../components/footer.php')?>