<?php

	include('../config/config.php');

	$id = $_GET['id'];
	$sql = "DELETE FROM food_admin WHERE id=$id";
	$res = mysqli_query($conn, $sql);

	if($res == TRUE) {
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
		header('location:'.ADMINREDIRECT);
	} else {
		$_SESSION['delete'] = "<div class='error'>Something went terribly wrong...</div>";
		header('location:'.ADMINREDIRECT);
	}

?>