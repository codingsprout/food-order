<?php 

	include('../config/config.php');

	if(isset($_GET['id']) && isset($_GET['image_name'])) {

		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if($image_name != '') {

			$path = '../images/'.$image_name;
			$remove = unlink($path);

			if($remove == false) {

				$_SESSION['upload'] = "<div class='error'>Something went wrong, failed to remove image!</div>";
				header('location:'.FOODREDIRECT);
				die();
			}
		}

		$sql = "DELETE FROM food_type WHERE id=$id";
		$res = mysqli_query($conn, $sql);

		if($res == true) {
			$_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
			header('location:'.FOODREDIRECT);
		} else {
			$_SESSION['delete'] = "<div class='error'>Something failed, food was not deleted</div>";
			header('location:'.FOODREDIRECT);
		}

	} else {
		$_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
		header('location:'.FOODREDIRECT);
	}

?>