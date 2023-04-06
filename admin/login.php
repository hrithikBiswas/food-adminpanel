<?php require_once( '../config.php' ); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once( 'inc/header.php' ); ?>
<style>
	body {
		height: 100vh !important;
		background-image: url(../uploads/cover.png);
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
	}
</style>
<body class="login-page d-flex justify-content-center align-items-center align-content-center flex-column">
	
	<!-- Pre-Loader -->
	<script>
		start_loader();
	</script>

	<h1 class="page-title text-white px-4 py-5">
		<b>Fast Food Ordering System</b>
	</h1>

	<div class="col-11 col-sm-8 col-md-5 col-xl-3 ">
		<div class="card">
			<div class="card-body">
				<p class="card-title float-none text-center mb-3">Please enter your credentials</p>
				
				<form id="login-form" action="" method="post" class="g-3 bg-white p-2 rounded-3">
					<div class="col-md-12">
						<div class="input-group">
							<input type="text" class="form-control" name="username" id=""
								placeholder="Username" required>
							<div class="input-group-text"><i class="fa-solid fa-user"></i></div>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<div class="input-group">
							<input type="password" class="form-control" name="password" id=""
								placeholder="Password" required>
							<div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
						</div>
					</div>
					<div class="col-12 mt-3 text-end">
						<button class="btn btn-primary" type="submit">Sign In</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
	<?php require_once( './inc/footer.php' ); ?>

	<script>
		$(document).ready(function(){
			end_loader();
		})
	</script>
</body>

</html>
