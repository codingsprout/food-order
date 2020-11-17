<?php

	session_start();

	define('LOCALHOST', 'localhost');	
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'food-order');

	define('PASSWORDADMIN', 'http://localhost/food-order/admin/administration/password.php');
	define('UPDATEADMIN', 'http://localhost/food-order/admin/administration/update-admin.php');
	define('DELETEADMIN', 'http://localhost/food-order/admin/administration/delete-admin.php');
	define('ADMINREDIRECT', 'http://localhost/food-order/admin/administration/administrator.php');
	define('HOMEPAGE', 'http://localhost/food-order/admin/pages/index.php');
	define('LOGIN', 'http://localhost/food-order/admin/user/login.php');

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>