<?php
	include('../config/config.php');

	if(!isset($_SESSION['user'])) {
		$_SESSION['no-auth'] = "<div class='error txt-c'>Please login to access the Admin Panel</div>";
		header('location:'.LOGIN);
	}
?>