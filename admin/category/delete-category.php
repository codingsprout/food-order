<?php

	include('../config/config.php');

	if(isset($_GET['id']) AND isset($_GET['image_name'])) {
		
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		if($image_name != '') {

			$path = "../images/".$image_name;
			$remove = unlink($path);

			if($remove == false) {

				$_SESSION['remove'] = "<div class='error'> Something went wrong!</div>";
				header('location:'.CATEGORYREDIRECT);
				die();
				
			}
		}

		$sql = "DELETE FROM food_category WHERE id=$id";
		$res = mysqli_query($conn, $sql);

		if($res == true) {

			$_SESSION['delete'] = "<div class='success'> Category successfully deleted!</div>";
			header('location:'.CATEGORYREDIRECT);
		} else {
			$_SESSION['delete'] = "<div class='error'> Something went wrong!</div>";
			header('location:'.CATEGORYREDIRECT);
		}
	} else {
		header('location:'.CATEGORYREDIRECT);
	}

?>