<?php include('../components/menu.php') ?>


<div class="main-content">
	<div class='wrapper'>
		<h1>Dashboard</h1>

		<?php 	

			if(isset($_SESSION['login'])) {
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			} 
			
		?>

		<div class="col-section txt-c">
			<h1>5</h1>
			<br />
			Categories
		</div>

		<div class="col-section txt-c">
			<h1>5</h1>
			<br />
			Categories
		</div>

		<div class="col-section txt-c">
			<h1>5</h1>
			<br />
			Categories
		</div>

		<div class="col-section txt-c">
			<h1>5</h1>
			<br />
			Categories
		</div>

		<div class="fix"></div>

	</div>
</div>

<?php include('../components/footer.php') ?>