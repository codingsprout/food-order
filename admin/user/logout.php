<?php

	include('../config/config.php');
	session_destroy();
	header('location:'.LOGIN);
?>