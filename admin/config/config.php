<?php

	session_start();

	define('LOCALHOST', 'localhost');	
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'food-order');

	define('UPDATEFOOD', 'http://localhost/food-order/admin/food/update-food.php' );
	define('DELETEFOOD', 'http://localhost/food-order/admin/food/delete-food.php');
	define('ADDFOOD', 'http://localhost/food-order/admin/food/add-food.php');
	define('FOODREDIRECT', 'http://localhost/food-order/admin/food/food.php');
	define('FOODIMAGE', 'http://localhost/food-order/admin/images/');

	define('UPDATECATEGORY', 'http://localhost/food-order/admin/category/update-category.php');
	define('DELETECATEGORY', 'http://localhost/food-order/admin/category/delete-category.php');
	define('ADDCATEGORY', 'http://localhost/food-order/admin/category/add-category.php');
	define('CATEGORYREDIRECT', 'http://localhost/food-order/admin/category/category.php');
	define('CATEGORYIMAGE', 'http://localhost/food-order/admin/images/');

	define('PASSWORDADMIN', 'http://localhost/food-order/admin/administration/password.php');
	define('UPDATEADMIN', 'http://localhost/food-order/admin/administration/update-admin.php');
	define('DELETEADMIN', 'http://localhost/food-order/admin/administration/delete-admin.php');
	define('ADMINREDIRECT', 'http://localhost/food-order/admin/administration/administrator.php');
	
	define('HOMEPAGE', 'http://localhost/food-order/admin/pages/index.php');
	define('LOGIN', 'http://localhost/food-order/admin/user/login.php');

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>